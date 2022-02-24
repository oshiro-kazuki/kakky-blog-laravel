<?php

return [
    'APP_NAME' => 'kazukie',
    // 共通文字数指定
    'MAX_LENGTH'        => 191,
    'PASSWORD_LENGTH'   => 20,
    'TEL_LENGTH'        => 11,
    // 表示用文字指定
    'CONTENT_LENGTH_TEMPLATE' => 35,
    // 入力用文字指定
    'INPUT_TEXT_LENGTH' => 140,
    // バリデーション指定
    'PASSWORD_REGIX' => '(?=.*[A-Z])(?=.*[.?_])[0-9a-zA-Z.?_]{8,20}',
];