<?php 

namespace App\Http\Services\Mail;

use App\Jobs\SendMailJob;
use App\Http\Services\Mail\AbtractMailBase;

class MailResetPasswordService extends AbtractMailBase {
    public function sendMail($user, $link){

        $userId = $user->id;
        //return $user;

        $header = "Bạn đã yêu cầu đặt lại mật khẩu được liên kết với tài khoản {$this->getNameAccountCtv($userId)} của ban.
        Để xác nhận yêu cầu của bạn, vui lòng sử dụng mã gồm các chữ số dưới đây:";

        $this->setTitle("Đặt lại mật khẩu");//tuy chinh
        $this->setHeader($header);//tuy chinh
        $this->setFooter("Mã xác minh có hiệu lực trong 30 phút.Xin vui lòng không chia sẻ mã với bất kì ai.
        Nếu đây không phải hoạt động truy cập của bạn,vui lòng tạm thời vô hiệu hóa tài khoản và liên hệ chăm sóc khách hàng ngay tại abc và số điện thoại 1234568");//tuy chinh
        $this->setContent("");//tuy chinh
        $this->setExtraContent($link); 
  
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