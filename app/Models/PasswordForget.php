<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordForget extends Model
{
    use HasFactory;
    //disable update_at trong bang password_resets
    const UPDATED_AT = null;
    protected $fillable = ['email', 'token', 'created_at'];
    protected $table = "password_resets";

    protected $casts = [
        'tags' => 'array',
    ];

}
