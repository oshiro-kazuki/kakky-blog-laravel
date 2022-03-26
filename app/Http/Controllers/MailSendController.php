<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Owner\ContactMailOwner;
use App\Mail\ContactMailSend;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MailSendController extends Controller
{
    public function __construct()
    {
        $this->subject_list = array(
            '選択' => 0, // 選択なしを固定
            'ご相談'    => 1,
            'その他'    => 2, // 最後の連番にする
        );
        $this->app_info_mail_address = config('const.APP_INFO_MAIL_ADDRESS');
        $this->owner_mail_address    = config('const.OWNER_MAIL_ADDRESS');
        $this->max_length            = config('const.TEXT_LENGTH191');
        $this->text_length            = config('const.TEXT_LENGTH140');
    }

    public function showContactForm()
    {
        return view(
            'info.contact_mail', 
            [
                'subject_list' => $this->subject_list,
                'max_length'   => $this->max_length,
                'text_length'  => $this->text_length,
            ]
        );
    }

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name'      => 'required|string|max:'.$this->text_length,
            'email'     => 'required|string|email|max:'.$this->max_length,
            'subject'   => 'not_in:0',
            'content'   => 'required|string|max:'.$this->text_length,
        ]);
    }

    public function contactMailSend(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect('/info/contact_mail')->withErrors($validator)->withInput();
        }

        $postData = $request->all();
        $postData['is_subject'] = '';
        $subject = intval($postData['subject']);
        foreach($this->subject_list as $key => $value){
            if($subject === $value){
                $postData['is_subject'] = $key;
            }
        }
        // 管理者へメール送信
        Mail::to($this->owner_mail_address)->send(
            new ContactMailOwner($postData)
        );
        // ユーザーへメール送信
        Mail::to($postData['email'])->send(
            new ContactMailSend($postData, $this->app_info_mail_address)
        );
        return redirect('/');
    }
}