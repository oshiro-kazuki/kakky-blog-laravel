<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>wan-like : プロフィール</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/info/profile.css') }}">
    </head>
    <body>
        @include('common.header')

        <article>
            <div class="profile_main_image">
                <img src="/img/info/profile/profile.jpg">
            </div>
        </article>
        <article>
            <div class="profile_detail">
                <h3>略歴</h3>
                <ul class="profile_detail_list">
                    <li><p>税理士事務所</p><span>11年</span></li>
                    <li><p>webエンジニア(現在)</p><span>1年</span></li>
                </ul>
                <h3>拠点</h3>
                <ul class="profile_detail_list">
                    <li><p>沖縄県沖縄市</p></li>
                </ul>
            </div>
        </article>
        <main>
            <div class="profile_comment">
                <h1>コメント</h3>
                <p>初めまして。<br>koと申します。<br>webエンジニアになって１年になります。<br>長年勤めた税理士事務所では税金を通してお客様の課題を解決し喜ばれることにとてもやりがいを感じておりました。<br>現在は自身が開発したアプリケーションで皆様に貢献できたらと思い、日々精進しております。<br>ホームページの作成やアプリケーションの開発のことで、ご依頼・ご相談があれば是非ご連絡をよろしくお願いいたします。</p>
            </div>
            <div id="contact_btn"></div>
        </main>

        @include('common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/component/contact_btn.js') }}"></script>
    </body>
</html>
