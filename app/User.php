<?php

namespace App;

use DateTimeInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'employeenumber','name','username','company','Department', 'Manager','level','vacationsbalance','email','permissionshours',
        'Manageremail',
    ];

    protected $hidden = [
        'password', 'remember_token','Loginnum',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Vacation()
    {
        return $this->hasMany(Holiday::class,'name', 'name');
    }

}
