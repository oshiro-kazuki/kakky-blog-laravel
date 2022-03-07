<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailJapanese;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        // 日本語化したメールを送信
        $this->notify(new VerifyEmailJapanese);
    }

    public function getGuard()
    {
        return $this->guard;
    }
}