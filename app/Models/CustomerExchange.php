<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerExchange extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $connection = 'mmo-exchange';

    //====================vai trò=====================================
    const CUSTOMER = 1;
    const BUSINESSMAN = 2;

    //====================trang thái của người dùng====================

    const UNACTIVE=0;
    const ACTIVE=1;
    const DISABLE=2;


    
 
     //role
 
   
     const ADMIN=3;
     const CTV=4;

    //============================================================
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'status',
        'phone',
        "address",
        "start_order_expired_time",
        'image_bank', 
        'image_idCard',
        'insurance_money',
        'reason'
    ];


   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    
    
   
    


    
}
