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

Route::get('/', function () {
    return view('top');
});

// 問い合わせ用メール
Route::prefix('/info/contact_mail')->group(function() {
    Route::get('/', 'MailSendController@index')->name('contact_mail.index');
    Route::post('/send', 'MailSendController@mailSend')->name('contact_mail.send');
});

// プロフィール
Route::get('/info/profile', function () {
    return view('/info/profile/index');
});