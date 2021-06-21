<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract 
{
     use Authenticatable;
     use HasFactory, Notifiable;
  
     const ACTIVE = 1;
     const UNACTIVE = 0;
     const DISABLE = 2;
 
     //role
 
     const ADMIN=3;
     const CTV=4;
 
   
    
    protected $fillable = ['name', 'email', 'role','status', 'avatar', 'phone','password'];
    protected $hidden=['email_verified_at','password','remember_token'];
    protected $table = "users";
    protected $connection = 'mmo-admin';

    

    public function hasRole(string $role) : bool
    {
        if( $this->convertRole(Auth::user()->role) == $role){
            return true;
        }
        return false;
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

    public static function convertRole(int $role):string
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
