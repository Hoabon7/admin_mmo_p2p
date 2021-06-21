<?php 

namespace App\Http\Services\Mail;

use App\Models\User;
use App\Models\Customer;


abstract class  AbtractMailBase
{
   
   public $customer;
   public $user;

   public $nameTitle, $namHeader, $nameFooter, $extraContent, $content;

    public function __construct(Customer $customer, User $user)
    {
         $this->customer = $customer;
         $this->user = $user;
    }


    public function setTitle (string $nameTitle) {
         $this->nameTitle = $nameTitle;
    }
   //getTitle
    public function getTitle():string
    {
        return $this->nameTitle;
    }
   
    public function setHeader(string $nameHeader) {
        $this->namHeader = $nameHeader;
    }

    public function getHeader():string
    {
            return $this->namHeader;
    }

    public function setContent( $content) {
        return $this->content = $content;
    }

   public function getContent()
   {
      return $this->content;
   }

   public function setExtraContent( $extraContent = null) {
        $this->extraContent = $extraContent;
   }

   public function getExtraContent() {
        return $this->extraContent;
   }

   public function setFooter(String $nameFooter) {
       $this->nameFooter = $nameFooter;
   }

   public function getFooter():string
   {
        return $this->nameFooter;   
   }
 
   public function toCustomer($userId):string
   {
      return $this->customer->find($userId)->email;
   }

   public function toCtv($userId):string {
      return User::find($userId)->email;
   }
   /**
    * code to active account customer
    * @param return string code
    */

   // public function getCodeCustomer($userId)
   // {
   //    $code= $this->customer->find($userId)->code()
   //                          ->latest('created_at')->first()->code;
   //    return $code;
   // }
   /**
    *  get infomation of customer
    *   @param userId;
    *
    */
   
   // public function getInfoCustomer($userId)
   // {
   //    $datainfoCustomer= $this->customer->find($userId)->history()
   //                         ->latest('created_at')->first();
   //    return $datainfoCustomer;
   // }

   // public function getInfoCtv($userId)
   // {
   //    $datainfoCustomer= $this->user->find($userId)->history()
   //                         ->latest('created_at')->first();
   //    return $datainfoCustomer;
   // }

   public function getNameAccountCustomer($userId):string
   {
      return $this->customer->find($userId)->name;
   }

   public function getNameAccountCtv($userId):string
   {
      return $this->user->find($userId)->name;
   }

   public function getActiveCustomer($userId):int
   {
      return $this->customer->find($userId)->status;
   }

   public function getActiveCtv($userId):int
   {
      return $this->user->find($userId)->status;
   }

   public function getLinkResetPass($link):string
   {
      return $link;
   }

   

  
}
