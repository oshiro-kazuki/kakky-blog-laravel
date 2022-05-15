<?php

namespace App\Libs\Mail\Owner;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogCommentOwnerMailSend extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($blog_url, $comment, $name)
    {
        $this->blog_url = $blog_url;
        $this->comment  = $comment;
        $this->name     = $name;
    }

    public function build()
    {
        return $this->from(config('const.APP_INFO_MAIL_ADDRESS'))
        ->subject('ブログへのコメント受付')
        ->view(
            'mail.blog_comment',
            [
                'owner_flg' => true,
                'url'       => $this->blog_url,
                'comment'   => $this->comment,
                'name'      => $this->name,
            ]
        );
    }
}