<?php

Route::get('/', 'TopPageController@index');

// info系へアクセス
Route::prefix('/info')->group(function() {
    // お問い合わせメール画面
    Route::prefix('/contact_mail')->group(function() {
        Route::get('/', 'MailSendController@index')->name('contact_mail.index');
        Route::post('/send', 'MailSendController@mailSend')->name('contact_mail.send');
    });
    // プロフィール画面
    Route::get('/profile', function () {
        return view('/info/profile');
    });
    // プライバシーポリシー画面
    Route::get('/privacy_policy', function () {
        return view('/info/privacy_policy');
    });
});

// ニュース入力画面
Route::prefix('/news_input')->group(function() {
    Route::get('/', 'NewsInputController@index');
    Route::post('/post', 'NewsInputController@newsPost')->name('news_input.post');
});

// ニュース一覧画面
Route::prefix('/news')->group(function() {
    Route::get('/', 'NewsController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// オーナー用画面
Route::prefix('/owner')->group(function() {
    // ログイン画面表示
    Route::get('/login', 'Auth\LoginController@showOwnerLoginForm');
    Route::get('/register', 'Auth\RegisterController@showOwnerRegisterForm');
    Route::get('/logout', 'Auth\LoginController@ownerLogout');
    // 送信処理
    Route::post('/login', 'Auth\LoginController@ownerLogin')->name('ownerLogin');
    Route::post('/register', 'Auth\RegisterController@createOwner')->name('ownerRegister');
    // 認証後処理
    Route::middleware('auth:owner')->group(function(){
        Route::get('/', 'OwnerController@index');
    });
});