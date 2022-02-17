<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Libs\AuthForm;

class RegisterRequest extends FormRequest
{
    public function __construct() {
        $af                     = new AuthForm();
        $this->required_error   = $af->required_error;
        $this->form_error       = $af->form_error;
        $this->max_length       = $af->max_length;
        $this->password_regex   = $af->password_regex;
        $this->not_half_size    = $af->not_half_size;
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
            'password'              => 'bail|required|string|confirmed|regex:/^'.$this->password_regex.'$/',
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
            'address.regex'                     => $this->form_error,
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
