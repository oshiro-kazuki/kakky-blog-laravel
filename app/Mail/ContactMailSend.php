<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * メール送信引数
     *
     * @var array
     */
    private $postData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postData)
    {
        $this->postData = $postData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@kakky-blog.com')
        ->subject('お問い合わせについて')
        // ->view()
        ->text(
            'info.contact_mail.mail_template',
            [
                'postData' => $this->postData
            ]
        );

    }
}
