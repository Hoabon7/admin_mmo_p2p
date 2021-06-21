<?php

namespace App\Http\Services\Mail;

use App\Http\Services\Mail\MailBase;
use App\Jobs\SendMailJob;

class MailAddReasonService extends AbtractMailBase{
    
    
    public function sendMail($user){

        $userId = $user->id;

        $header = "Các thông tin cần thiết trong quá trình trở thành thương nhân của bạn bị thiếu,xin vui lòng update lại thông tin.";

        $this->setTitle("Bổ sung thông tin cá nhân");
        $this->setHeader($header);
        $this->setFooter("Nếu đây không phải hoạt động truy cập của bạn,
        vui lòng tạm thời vô hiệu hóa tài khoản và liên hệ chăm sóc khách hàng ngay tại abc và số điện thoại 1234568");
        $this->setContent("");
        $this->setExtraContent(""); 
  
        $emailJob = new SendMailJob(
            $this->getTitle(),
            $this->getHeader(),
            $this->getContent(), 
            $this->getExtraContent(), 
            $this->getFooter(),
            $this->toCustomer($userId)
        );
        
        dispatch($emailJob);
        
     }
   
}