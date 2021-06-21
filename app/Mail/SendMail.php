<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public  $nameTitle, $nameHeader, $content, $extraContent, $nameFooter, $toCustomer;

    public function __construct($nameTitle, $nameHeader, $content, string  $extraContent = null, $nameFooter, $toCustomer)
    {
        $this->nameTitle = $nameTitle;
        $this->nameHeader = $nameHeader;
        $this->content = $content;
        $this->extraContent = $extraContent;
        $this->nameFooter = $nameFooter;
        $this->toCustomer = $toCustomer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sendmail');
    }
}
