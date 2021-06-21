<?php

namespace App\Http\Controllers\admin;


use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\admin\CreateCtvRequest;
use App\Http\Requests\admin\UpdateCtvRequest;
use App\Http\Services\Mail\MailNewPasswordService;
use App\Http\Services\Mail\MailNotificationActiveOrUnactive;

class ManagingCtvController extends Controller
{
    protected $user;
    protected $commonService;
    protected $mailNewPasswordService;

    protected $managingCustomerController;
    protected $mailNotificationActiveOrUnactive;

    //managing human resource
    public function __construct(
        User $user, 
        CommonService $commonService, 
        MailNewPasswordService $mailNewPasswordService,
        MailNotificationActiveOrUnactive $mailNotificationActiveOrUnactive
    )
    {
        $this->user = $user;
        $this->commonService = $commonService;
        $this->mailNewPasswordService = $mailNewPasswordService;
        $this->mailNotificationActiveOrUnactive = $mailNotificationActiveOrUnactive;
        $this->middleware('auth');
    }

    public function all(){
        $dataCTV = $this->user->where('role', $this->user::CTV)->get();
        return view('quantri_ctv.listCtv')->with('dataCTV', $dataCTV);
    }

    public function getDetail(Request $request){
        $user = $this->user->find($request->id);
       
       
        return view('quantri_ctv.detail')->with('user', $user);
    }

    

    public function create (){
        return view('quantri_ctv.create');
    }

    public function store (CreateCtvRequest $request){
        try {
            $dataCtv = $request->all();
            $passWord = $this->commonService->randomPassword();
            $dataCtv['status'] = $this->user::ACTIVE;
            $dataCtv['role'] = $this->user::CTV;
            $dataCtv['password'] = bcrypt($passWord);   

            
            $ctv=$this->user->create($dataCtv);
            //send password cho ctv
            $this->mailNewPasswordService->sendMail($ctv,$passWord);
            return $this->responseSuccess($ctv);
        } catch (\Throwable $th) {
           Log::debug($th->getMessage());
           return $this->responseFail($th->getMessage());
        }
    }

    public function edit (Request $request){
        $ctvId = $request->id;
        $dataCtv = $this->user->find($ctvId);
        return view('quantri_ctv.edit')->with('dataCtv', $dataCtv);
        // return $dataCtv;
    }


    public function update (UpdateCtvRequest $request){
        try {
            $dataCtv=$this->user->where('id', $request->id)->update([
                'name' => $request->name,
                'phone' => $request->phone
            ]);
            return $this->checkUpdateCtv($dataCtv);
            

        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return $this->responseFail($th->getMessage());
        }
        
    }

    public function checkUpdateCtv(bool $dataCtv){
        if ($dataCtv == 1) {
            Session::flash('notifi', 'Update thành công!');
            return redirect()->back();
        }
        return Session::flash('notifi', 'update không thành công!');
    }

    public function updateStatusCtv(int $ctvId, int $status){
        return $this->user::where( 'id', $ctvId)->update([
            'status' => $status
        ]);
    }

    public function isDisableStatus (Request $request){
        $ctvId = $request->id;
        $ctvStatus = $request->status;

        $ctv = $this->user->where('id', $ctvId)->first();
        if($ctvStatus == $this->user::ACTIVE) {
            $this->updateStatusCtv($ctvId, $this->user::DISABLE);
            Session::flash('notifi', 'Tài khoản đã được khóa');
            $this->mailNotificationActiveOrUnactive->sendMail($ctv,"Vô hiệu hóa");
            
        }else {
            $this->updateStatusCtv($ctvId, $this->user::ACTIVE);
            Session::flash('notifi', 'Tài khoản đã được mở');
            $this->mailNotificationActiveOrUnactive->sendMail($ctv,"Được kích hoạt");
            
        }
        return redirect()->back();
       
    }
}
