<?php 

namespace App\Http\Services\Mail;

use App\Models\Customer;
use App\Jobs\SendMailJob;
use App\Http\Services\Mail\MailBase;


class MailNewPasswordService extends AbtractMailBase{
    public function sendMail($user, $newPassword){

        $userId = $user->id;
        //return $user;

        $this->setTitle("Admin cấp mật khẩu");//tuy chinh
        $this->setHeader("Bạn được cấp mật khẩu mới.để đăng nhập và thay đổi mật khẩu xin vui lòng click vào link sau:");//tuy chinh
        $this->setFooter("Đây là mật khẩu truy cập của bạn.xin vui lòng truy cập và đổi lại mật khẩu.
        Nếu đây không phải hoạt động truy cập của bạn,vui lòng tạm thời vô hiệu hóa tài khoản và liên hệ chăm sóc khách hàng ngay tại abc và số điện thoại 1234568.");//tuy chinh
        $this->setContent($newPassword);//tuy chinh
        $this->setExtraContent(""); 
  
        $emailJob = new SendMailJob(
            $this->getTitle(), 
            $this->getHeader(),
            $this->getContent(), 
            $this->getExtraContent(), 
            $this->getFooter(),
            $this->toCtv($userId)
        );
        
        dispatch($emailJob);
        
     }
}