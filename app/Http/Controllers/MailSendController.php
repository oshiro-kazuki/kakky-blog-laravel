<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Mail;
use App\Mail\Owner\ContactMailOwner;
use App\Mail\ContactMailSend;

class MailSendController extends Controller
{
    public function __construct()
    {
        $this->app_info_mail_address = config('const.APP_INFO_MAIL_ADDRESS');
        $this->owner_mail_address    = config('const.OWNER_MAIL_ADDRESS');
    }

    public function showContactForm()
    {
        return view('info.contact_mail');
    }

    public function contactMailSend(MailRequest $mailRequest){
        $postData = $mailRequest->all();
        // 管理者へメール送信
        Mail::to($this->owner_mail_address)->send(
            new ContactMailOwner($postData)
        );
        // ユーザーへメール送信
        Mail::to($postData['contact_mail_email'])->send(
            new ContactMailSend($postData, $this->app_info_mail_address)
        );
        return redirect('/');
    }
}