<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Mail;
use App\Mail\ContactMailSend;

class MailSendController extends Controller
{
    public function index()
    {
        return view('info.contact_mail.index');
    }

    public function mailSend(MailRequest $mailRequest){
        $postData = $mailRequest->all();

        Mail::to($postData['contact_mail_email'])->send(new ContactMailSend($postData));
        
        return view('top');
    }
}
