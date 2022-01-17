<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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