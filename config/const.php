<?php

return [
    'APP_NAME'              => 'kakky-blog',
    'APP_INFO_MAIL_ADDRESS' => 'info@kakky-blog.com',
    'OWNER_MAIL_ADDRESS'    => 'ka.oo1213mi@gmail.com',
    // 共通文字数指定
    'MAX_LENGTH'        => 191,
    'PASSWORD_LENGTH'   => 20,
    'TEL_LENGTH'        => 11,
    'TITLE_LENGTH'      => 20,
    // 表示用文字指定
    'CONTENT_LENGTH_TEMPLATE' => 35,
    // 入力用文字指定
    'INPUT_TEXT_LENGTH' => 140,
    'BLOG_TEXT_LENGTH' => 1000,
    // バリデーション指定
    'PASSWORD_REGIX' => '/^(?=.*[A-Z])(?=.*[.?_])[0-9a-zA-Z.?_]{8,20}$/', // パスワード
    'NOT_HALF_REGIX' => '/^[^\x01-\x7E\uFF61-\uFF9F]+$/',                 // 半角不可
    'TELL_REGIX'     => '/^0[0-9]{10}$/',                                 // 電話番号
    // パス指定
    'OWNER_IMAGE_PATH' => '/storage/owner/profile/',
    'BLOG_IMAGE_PATH'  => '/storage/blog/',
];