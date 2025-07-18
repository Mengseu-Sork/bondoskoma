<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['email', 'password'];
        // protected $hidden = ['password'];

}
