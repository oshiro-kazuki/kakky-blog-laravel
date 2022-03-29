<?php

Route::get('/', 'TopPageController@index');

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

// ブログ
Route::prefix('/blog')->group(function($id) {
    Route::get('/', 'BlogController@list');
    Route::get('/{id}', 'BlogController@detail');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// 一時的にエラー画面へ
// Route::get('/login', function(){
//     return view('error.none_page');
// });
Route::get('/register', function(){
    return view('error.none_page');
});

// オーナー用画面
Route::prefix('/owner')->group(function() {
    // 画面表示
    Route::get('/register', 'Auth\RegisterController@showOwnerRegisterForm')->name('owner.register');
    Route::get('/login', 'Auth\LoginController@showOwnerLoginForm')->name('owner.login');
    Route::get('/logout', 'Auth\LoginController@logout');
    // 送信処理
    Route::post('/register', 'Auth\RegisterController@createOwner');
    Route::post('/login', 'Auth\LoginController@login');
    // 認証後処理
    Route::get('/', 'OwnerController@index')->middleware('verified');
    // ニュース入力画面
    Route::prefix('/news_input')->group(function() {
        Route::get('/', 'NewsInputController@index');
        Route::post('/post', 'NewsInputController@newsPost')->name('news_input.post');
    });
    // ブログ画面
    Route::prefix('/blog')->group(function() {
        // ブログ一覧画面
        Route::get('/', 'BlogOwnerController@showList');
        // ブログ入力画面
        Route::prefix('/blog_input')->group(function() {
            Route::get('/', 'BlogOwnerController@showinput');
            Route::post('/post', 'BlogOwnerController@blogPost')->name('blog_input.post');
        });
        // ブログ編集画面
        Route::prefix('/blog_edit')->group(function() {
            Route::get('/{id}', 'BlogOwnerController@showEdit');
            Route::post('/post', 'BlogOwnerController@blogEdit')->name('blog_edit.post');
        });
    });
});