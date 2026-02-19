<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Container\Attributes\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use HasFactory, Notifiable, Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;
        



    protected $fillable = [
        'name',
        'email',
        'password',

        
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}