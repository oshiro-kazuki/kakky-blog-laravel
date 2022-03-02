<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'owner';

    protected $fillable = [
        'id',
        'owner_id',
        'name',
        'address',
        'tel',
        'email',
        'password',
        'profile',
        'profile_image',
        'Withdrawal',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}