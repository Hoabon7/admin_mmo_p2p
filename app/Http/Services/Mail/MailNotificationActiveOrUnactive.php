<?php 

namespace App\Http\Services\Mail;

use App\Jobs\SendMailJob;
use App\Http\Services\Mail\AbtractMailBase;

class MailNotificationActiveOrUnactive extends AbtractMailBase {


    public function sendMail($user, $status){

        $userId = $user->id;
        //return $user;

        $header = "Tài khoản của bạn đã {$status}";

        $this->setTitle("Thông báo trạng thái của tài khoản");//tuy chinh
        $this->setHeader($header);//tuy chinh
        $this->setFooter("Nếu đây không phải hoạt động truy cập của bạn,vui lòng tạm thời vô hiệu hóa tài khoản và liên hệ chăm sóc khách hàng ngay tại abc và số điện thoại 1234568");//tuy chinh
        $this->setContent("");//tuy chinh
        $this->setExtraContent(""); 
        $emailJob = null;
        if($user->role == $this->user::ADMIN || $user->role == $this->user::CTV){
            $emailJob = new SendMailJob(
                $this->getTitle(), 
                $this->getHeader(),
                $this->getContent(), 
                $this->getExtraContent(), 
                $this->getFooter(),
                $this->toCtv($userId)
            );
        }else{
            $emailJob = new SendMailJob(
                $this->getTitle(), 
                $this->getHeader(),
                $this->getContent(), 
                $this->getExtraContent(), 
                $this->getFooter(),
                $this->toCustomer($userId)
            );
        }
        
        
        dispatch($emailJob);
        
     }

     
}