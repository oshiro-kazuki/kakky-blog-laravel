<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact_mail_name'    => 'required',
            'contact_mail_email'   => 'required|email',
            'contact_mail_subject' => 'not_in:"0"',
            'contact_mail_content' => 'required',
        ];
    }

    /**
     * バリデーションエラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'contact_mail_name.required'    => 'お名前を入力してください。',
            'contact_mail_email.required'   => 'メールアドレスを入力してください。',
            'contact_mail_email.email'   => 'メールアドレスの形式が違います。',
            'contact_mail_subject.not_in' => '件名を選択してください。',
            'contact_mail_content.required' => 'お問い合わせ内容を入力してください。',
        ];
    }
}
