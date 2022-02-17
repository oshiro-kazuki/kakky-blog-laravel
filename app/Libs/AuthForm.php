<?php

namespace App\Libs;

class AuthForm
{
    public $required_error  = 'を入力してください。';
    public $form_error      = '入力内容に誤りがあります。';
    public $max_length      = '191';
    public $password_regex  = '(?=.*[A-Z])(?=.*[.?_])[0-9a-zA-Z.?_]{8,20}';
    public $not_half_size   = '\x01-\x7E\uFF61-\uFF9F';
}
?>