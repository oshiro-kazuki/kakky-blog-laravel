<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmailJapanese extends Notification
{
    use Queueable;

    public static $toMailCallback;

    public function via($notifiable)
    {
        return ['mail'];
    }

    // URL取得と送信
    public function toMail($notifiable)
    {
        //URL生成
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        // メール送信
        return (new MailMessage)
        ->subject(Lang::get('メールアドレスの検証'))
        ->view('mail.verify', ['url' => $verificationUrl]);
    }

    // URL生成
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
                'user_type' => $notifiable->getGuard(),
            ]
        );
    }
}