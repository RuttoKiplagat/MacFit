<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;
        



    protected $fillable = [
        'name',
        'email',
        'password',

        'is_active',
        'user_image',
        'role_id',
        
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected  $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    
    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function abilities() {
        return [
            'admin' => $this->role->id == 1,
            'user' => $this->role->id == 2,
            'trainer' => $this->role->id == 3,
            'staff' => $this->role->id == 4,
            ];
    }   
}