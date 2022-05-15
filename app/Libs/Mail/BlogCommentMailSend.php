<?php

namespace App\Libs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogCommentMailSend extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($blog_url, $comment)
    {
        $this->blog_url = $blog_url;
        $this->comment  = $comment;
    }

    public function build()
    {
        return $this->from(config('const.APP_INFO_MAIL_ADDRESS'))
        ->subject('ブログへのコメント受付')
        ->view(
            'mail.blog_comment',
            [
                'owner_flg' => false,
                'url'       => $this->blog_url,
                'comment'   => $this->comment,
            ]
        );
    }
}