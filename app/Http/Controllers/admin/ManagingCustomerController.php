<?php

namespace App\Http\Controllers\admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\admin\AddReasonRequest;
use App\Http\Services\Mail\MailAddReasonService;
use App\Http\Services\Mail\MailApprovalBusinessman;
use App\Http\Services\Mail\MailNotificationActiveOrUnactive;

class ManagingCustomerController extends Controller
{
    protected $customer;
    protected $commonService;
    protected $mailAddReasonService;
    protected $mailNotificationActiveOrUnactive;
    protected $mailApprovalBusinessman;
    public function __construct(
        CommonService $commonService, 
        Customer $customer,
        MailAddReasonService $mailAddReasonService,
        MailNotificationActiveOrUnactive $mailNotificationActiveOrUnactive,
        MailApprovalBusinessman $mailApprovalBusinessman
    )
    {
        $this->customer = $customer;
        $this->middleware('auth');
        $this->commonService = $commonService;
        $this->mailAddReasonService = $mailAddReasonService;
        $this->mailNotificationActiveOrUnactive = $mailNotificationActiveOrUnactive;
        $this->mailApprovalBusinessman = $mailApprovalBusinessman;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getListCustomer()
    {
        $dataCustomer = $this->customer->whereIn('role', [$this->customer::CUSTOMER, $this->customer::BUSINESSMAN])
                                        ->get();
        return view('quantri_customer.listCustomer')->with('dataCustomer', $dataCustomer);
    }
    
    public function getDetailCustomer( Request $request) {
        $customer = $this->customer->find($request->id);
        $imageBank = $this->commonService->splitImage($customer->image_bank);
        $imageIdCard = $this->commonService->splitImage($customer->image_idCard);
        $data['customer'] = $customer;
        $data['image_bank'] = $imageBank;
        $data['image_idCard'] = $imageIdCard;
        return view('quantri_customer.detail')->with('data', $data);

    }
    
    public function setCustomerBecomeBusinessmen(Request $request){
        $userId = $request->id;
        $checkUpdateRole = $this->updateRoleCustomer($userId);
        if($checkUpdateRole != 1) Session::flash('notifi', 'Q??a tr??nh x??t kh??ng ho??n t???t!');
        else {
            Session::flash('notifi', 'X??t th??nh c??ng!');
            return redirect()->back();
        }
        
    }
    

    public function isDisableStatus(Request $request){
        $customerId = $request->id;
        $customer = $this->customer->where('id', $customerId)->first();

        $customerStatus = $request->status;
        if($customerStatus == $this->customer::ACTIVE) {
            $this->updateStatusCustomer($customerId, $this->customer::DISABLE);
            Session::flash('notifi', 'T??i kho???n ???? ???????c kh??a');
            $this->mailNotificationActiveOrUnactive->sendMail($customer, "v?? hi???u h??a");
        }else {
            $this->updateStatusCustomer($customerId, $this->customer::ACTIVE);
            Session::flash('notifi', 'T??i kho???n ???? ???????c m???');
            $this->mailNotificationActiveOrUnactive->sendMail($customer, "???????c k??ch ho???t");
            
        }

        return redirect()->back();
    }

    public function updateRoleCustomer($customerId){
        $updateCustomer = $this->customer::where( 'id', $customerId)->update([
            'role' => $this->customer::BUSINESSMAN
        ]);

        if($updateCustomer == 1) {
            $customer = $this->customer->find($customerId);
            $this->mailApprovalBusinessman->sendMail($customer);
           
        }
        return $updateCustomer;
    }

    public function updateStatusCustomer(int $customerId, int $status){
        return $this->customer::where( 'id', $customerId)->update([
            'status' => $status
        ]);
    }

    public function createReason(Request $request){
        $customerId = $request->id;
        //return $customerId;
        return view('quantri_customer.additionalReason')->with('customerId', $customerId);
    }


    public function storeReason(Request $request){
       
        $userId = $request->id;

        $this->customer->where('id', $userId)->update([
            'reason' => $request->reason
        ]);
        $user=$this->customer->where('id', $userId)->first();
        Session::flash('notifi', 'b??? sung th??nh c??ng');

        $user = $this->customer->find($userId);
        $this->mailAddReasonService->sendMail($user);
        return redirect()->back();
       //send mail;
    }
}
