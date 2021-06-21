<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExchange extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    const UNACTIVE = 0;
    const DISABLE = 2;
 
     //role
 
     const ADMIN=3;
     const CTV=4;
 
   
    
    protected $fillable = ['name', 'email', 'role','status', 'avatar', 'phone','password'];
    protected $hidden=['email_verified_at','password','remember_token'];
    protected $table = "users";
    protected $connection = 'mmo-exchange';

    

    

    

   
}
