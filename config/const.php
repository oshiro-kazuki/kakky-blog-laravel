<?php

return [
    'APP_NAME'              => 'kakky-blog',
    'APP_INFO_MAIL_ADDRESS' => 'info@kakky-blog.com',
    'OWNER_MAIL_ADDRESS'    => 'ka.oo1213mi@gmail.com',
    // 制御フラグ
    'REGISTER_FLG' => false,
    // 共通文字数指定
    'PASSWORD_LENGTH'   => 20,
    'TEL_LENGTH'        => 11,
    'TEXT_LENGTH20'     => 20,
    'TEXT_LENGTH35'     => 35,
    'TEXT_LENGTH90'     => 90,
    'TEXT_LENGTH140'    => 140,
    'TEXT_LENGTH191'    => 191,
    'TEXT_LENGTH1000'   => 1000,
    // バリデーション指定
    'PASSWORD_REGIX' => '/^(?=.*[A-Z])(?=.*[.?_])[0-9a-zA-Z.?_]{8,20}$/', // パスワード
    'NOT_HALF_REGIX' => '/^[^\x01-\x7E\uFF61-\uFF9F]+$/',                 // 半角不可
    'TELL_REGIX'     => '/^0[0-9]{10}$/',                                 // 電話番号
    // パス指定
    'OWNER_IMAGE_PATH' => '/storage/owner/profile/',
    // ファイル系
    'NOPHOTO'  => '/img/nophoto.png',
];