<?php

namespace App\Libs\Mail\Owner;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailOwner extends Mailable
{
    use Queueable, SerializesModels;

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
        ->subject('お問い合わせの受付')
        ->view(
            'mail.contact_to_owner',
            [
                'postData' => $this->postData
            ]
        );
    }
}