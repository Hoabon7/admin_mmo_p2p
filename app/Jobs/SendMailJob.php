<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public  string $nameTitle, $nameHeader, $extraContent, $nameFooter, $toCustomer;

    public $content;

    public function __construct($nameTitle, $nameHeader, $content, string $extraContent = null, $nameFooter, $toCustomer)
    {
        $this->nameTitle = $nameTitle;
        $this->nameHeader = $nameHeader;
        $this->content = $content;
        $this->extraContent = $extraContent;
        $this->nameFooter = $nameFooter;
        $this->toCustomer = $toCustomer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendMail( $this->nameTitle, $this->nameHeader, $this->content, $this->extraContent, $this->nameFooter, $this->toCustomer,);
        Mail::to($this->toCustomer)->send($email);
    }
}
