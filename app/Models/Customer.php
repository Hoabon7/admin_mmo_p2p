<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use Notifiable;

    use HasFactory;
    protected $table = "customers";
    protected $connection = 'mmo-admin';
   

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

    public function code(){
        return $this->hasMany('App\Models\Authentication','user_id','id');
    }

    public function history(){
        return $this->hasMany('App\Models\LoginHistory','user_id','id');
    }

    public function notification(){
        return $this->hasMany('App\Models\Notification', 'customer_id', 'id');
    }

    public function authentication(){
        return $this->hasMany('App\Models\Authentication', 'user_id', 'id');
    }


    
    
   
    


    public function hasRole(int $role) : bool
    {
        if(Auth::user()->role == $role){
            return true;
        }
        return false;
    }


    public static function convertRoleFromIntToString( $role)
    {
        switch ($role) {
            case self::CUSTOMER:
                return "khách hàng";
                break;
            case self::BUSINESSMAN:
                return "Thương nhân uy tín";
            case self::CTV:
                return "Cộng tác viên";
            default:
                return "___";
                break;
        }
    }

    public static function convertStatusFromIntToString( $status)
    {
        switch ($status) {
            case self::ACTIVE:
                return "ACTIVE";
                break;
            case self::UNACTIVE:
                return "UNACTIVE";
            case self::DISABLE:
                return "DISABLE";
            default:
                return "___";
                break;
        }
    }

    // public function hasRole(string $role) : bool
    // {
    //     if($this->convertRole(Auth::user()->role)==$role){
    //         return true;
    //     }
    //     return false;
    // }

    public function convertRole(int $role) : string
    {
        switch ($role) {
            case self::ADMIN:
                return "ADMIN";
                break;
            case self::CTV:
                return "CTV";
                break;
            default:
                return "___";
                break;
        }
    }
}
