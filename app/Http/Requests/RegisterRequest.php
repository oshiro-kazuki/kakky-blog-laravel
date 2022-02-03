<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    private $required_error = 'を入力してください。';
    private $form_error     = '入力内容に誤りがあります。';
    private $max_length     = '191';
    private $letter         = '0-9a-zA-Z';
    private $symbol         = '.?_';
    private $requiredsymbol = '';
    private $password_max   = '20';
    private $password_min   = '8';
    private $password_regex = '';
    private $not_half_size  = '\x01-\x7E\uFF61-\uFF9F';

    public function __construct() {
        $this->requiredsymbol = '(?=.*[A-Z])(?=.*['.$this->symbol.'])';
        $this->password_regex = $this->requiredsymbol.'['.$this->letter.$this->symbol.']{'.$this->password_min.','.$this->password_max.'}';
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => 'required|string|max:'.$this->max_length,
            'address'               => 'required|string|max:'.$this->max_length.'|regex:/^[^ '.$this->not_half_size.']+$/',
            'tel'                   => 'required|string|regex:/^0[0-9]{10}$/',
            'email'                 => 'required|string|email|max:'.$this->max_length,
            'profile'               => 'string|max:140|nullable',
            'profile_image'         => 'file|max:3000|image|mimes:jpeg,png,jpg',
            'password'              => 'required|string|confirmed|regex:/^'.$this->password_regex.'$/',
            'password_confirmation' => 'required|string|regex:/^'.$this->password_regex.'$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                     => '会社・店舗名'.$this->required_error,
            'name.string'                       => $this->form_error,
            'name.max'                          => $this->form_error,
            'address.required'                  => '住所'.$this->required_error,
            'address.string'                    => $this->form_error,
            'address.max'                       => $this->form_error,
            'address.regex'                     => $this->form_error.'bb',
            'tel.required'                      => '電話番号'.$this->required_error,
            'tel.string'                        => $this->form_error,
            'tel.regex'                         => $this->form_error,
            'email.required'                    => 'メールアドレス'.$this->required_error,
            'email.string'                      => $this->form_error,
            'email.max'                         => $this->form_error,
            'email.email'                       => $this->form_error,
            'profile.string'                    => $this->form_error,
            'profile.max'                       => $this->form_error,
            'profile_image.file'                => 'アップロードできませんでした。',
            'profile_image.image'               => '画像ファイルではありません。',
            'profile_image.mimes'               => '拡張子がjpeg,jpg,pngではありません。',
            'profile_image.max'                 => '3MBを超えるファイルです。',
            'password.required'                 => 'パスワード'.$this->required_error,
            'password.string'                   => $this->form_error,
            'password.confirmed'                => '入力したパスワードが違います。',
            'password.regex'                    => $this->form_error,
            'password_confirmation.required'    => 'パスワード'.$this->required_error,
            'password_confirmation.string'      => $this->form_error,
            'password_confirmation.regex'       => $this->form_error,
        ];
    }
}
