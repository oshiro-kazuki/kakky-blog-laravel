<?php

namespace App\Libs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailSend extends Mailable
{
    use Queueable, SerializesModels;

    private $postData;
    private $app_info_mail_address;

    public function __construct($postData, $app_info_mail_address)
    {
        $this->postData              = $postData;
        $this->app_info_mail_address = $app_info_mail_address;
    }

    public function build()
    {
        return $this->from($this->app_info_mail_address)
        ->subject('お問い合わせについて')
        ->view(
            'mail.reception_to_user',
            [
                'postData' => $this->postData
            ]
        );

    }
}