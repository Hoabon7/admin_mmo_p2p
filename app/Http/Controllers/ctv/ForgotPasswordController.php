<?php

namespace App\Http\Controllers\ctv;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordForget;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ctv\ForgotPassWordRequest;
use App\Http\Services\Mail\MailResetPasswordService;

class ForgotPasswordController extends Controller
{
    protected $user;
    protected $passwordForget;
    protected $mailResetPassword;
    public function __construct(User $user,PasswordForget $passwordForget, MailResetPasswordService $mailResetPassword)
    {
        $this->user = $user;
        $this->passwordForget = $passwordForget;
        $this->mailResetPassword = $mailResetPassword;
    }
    public function create(){
        return view('ctv.CreateMailReset');
    }

    public function store(ForgotPassWordRequest $request){
        try {
            $emailRequest=$request->email;

            //return $emailRequest;
            $dataUser=$this->user::where('email',$emailRequest)->first();
            //return $dataUser;
            
            if(!empty($dataUser)){
                $token=Str::random(60);
                $passwordReset=$this->passwordForget->where('email',$emailRequest)->first();
                //return $passwordReset;
                if(!empty($passwordReset)){
                    $this->passwordForget->where('email',$emailRequest)->update([
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]); 
                }
                else{
                    $this->passwordForget::insert(['email' => $emailRequest, 'token' => $token, 'created_at' => Carbon::now()]);
                }
                $link=url("forgot_password/find/{$token}");
                $this->mailResetPassword->sendMail($dataUser, $link);
                return $this->response(200, true, "link reset send to your mail", 200, null);
            }else{
                return $this->response(400, false, "can not find email", 400,  null);
            }
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return $this->responseFail($th->getMessage());
        } 
    }

    public function find(Request $request)
    {
        $token = $request->token;
        $passwordReset = $this->passwordForget::where('token', $token)->first();

        if (!$passwordReset) return $this->response(404, false, 'This password reset token is invalid.', 404, null);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(30)->isPast()) {
            $passwordReset->delete();
            return $this->response(404, false, 'This password reset token is invalid.', 404, null);
        }
        return view('ctv.ResetPassword')->with('passwordReset', $passwordReset);
    }
    
    public function reset(Request $request)
    {
        $passwordReset = $this->passwordForget->where('token',$request->token)->first();
        //return $passwordReset;
        if (!$passwordReset){
            return $this->response(404, false, 'This password reset token is invalid.', 404, null);
        }
        $user = $this->user::where('email', $passwordReset->email)->first();
        //return $user;
        if (!$user){
            return $this->response(404, false, 'can not find a user with that e-mail address.', 404, null);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $this->passwordForget->where('token',$request->token)->delete();
        return $this->responseSuccess(null);
    }
}
