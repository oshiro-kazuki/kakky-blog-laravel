<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Mail;
use App\Mail\Admin\ContactMailAdmin;
use App\Mail\ContactMailSend;

class MailSendController extends Controller
{
    public function index()
    {
        return view('info.contact_mail.index');
    }

    public function mailSend(MailRequest $mailRequest){
        $postData = $mailRequest->all();
    
        // 管理者へメール送信
        Mail::to('ka.oo1213mi@gmail.com')->send(new ContactMailAdmin($postData));
        // ユーザーへメール送信
        Mail::to($postData['contact_mail_email'])->send(new ContactMailSend($postData));
        
        return redirect('/');
    }
}
