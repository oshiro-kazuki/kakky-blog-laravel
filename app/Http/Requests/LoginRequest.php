<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Libs\AuthForm;

class LoginRequest extends FormRequest
{
    public function __construct() {
        $af                     = new AuthForm();
        $this->required_error   = $af->required_error;
        $this->form_error       = $af->form_error;
        $this->max_length       = $af->max_length;
        $this->password_regex   = $af->password_regex;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login_email'       => 'required|string|email|max:'.$this->max_length,
            'login_password'    => 'required|string|regex:/^'.$this->password_regex.'$/',
        ];
    }

    public function messages()
    {
        return [
            'login_email.required'      => 'メールアドレス'.$this->required_error,
            'login_email.string'        => '',
            'login_email.email'         => '',
            'login_email.max'           => '',
            'login_password.required'   => 'パスワード'.$this->required_error,
            'login_password.string'     => '',
            'login_password.regex'      => ''
        ];
    }
}
