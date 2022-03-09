<?php

Route::get('/', 'TopPageController@index');
Route::get('/error', function(){
    return view('error');
});

// info系へアクセス
Route::prefix('/info')->group(function() {
    // お問い合わせメール画面
    Route::prefix('/contact_mail')->group(function() {
        Route::get('/', 'MailSendController@showContactForm');
        Route::post('/send', 'MailSendController@contactMailSend')->name('contact_mail.send');
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

// ニュース一覧画面
Route::prefix('/news')->group(function() {
    Route::get('/', 'NewsController@index');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// オーナー用画面
Route::prefix('/owner')->group(function() {
    // 画面表示
    Route::get('/register', 'Auth\RegisterController@showOwnerRegisterForm');
    Route::get('/login', 'Auth\LoginController@showOwnerLoginForm')->name('owner.login');
    Route::get('/logout', 'Auth\LoginController@logout');
    // 送信処理
    Route::post('/register', 'Auth\RegisterController@createOwner')->name('owner.register');
    Route::post('/login', 'Auth\LoginController@login');
    // 認証後処理
    Route::get('/', 'OwnerController@index')->middleware('verified');
    // ニュース入力画面
    Route::prefix('/news_input')->group(function() {
        Route::get('/', 'NewsInputController@index');
        Route::post('/post', 'NewsInputController@newsPost')->name('news_input.post');
    });
});