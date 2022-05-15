<?php

namespace App\Libs\Mail\Owner;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginMailOwner extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($os)
    {
        $this->os = $os;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('const.APP_INFO_MAIL_ADDRESS'))
        ->subject('ログイン成功')
        ->view(
            'mail.login',
            [
                'os'          => $this->os,
                'contact_url' => 'https://kakky-blog.com/contact_mail',
            ]
        );
    }
}