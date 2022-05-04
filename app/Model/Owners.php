<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Mail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailJapanese;
use App\Mail\Owner\LoginMailOwner;

class Owners extends Authenticatable implements MustVerifyEmail
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

    // メール認証
    public function sendEmailVerificationNotification()
    {
        // 日本語化したメールを送信
        $this->notify(new VerifyEmailJapanese);
    }

    // ログイン成功時にメール送信
    public function sendEmailLogin($email, $os)
    {
        Mail::to($email)->send(
            new LoginMailOwner($os)
        );
    }

    public function getGuard()
    {
        return $this->guard;
    }
}