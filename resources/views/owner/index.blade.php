<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} オーナー画面</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owner/index.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            <h1>{{ $owner['name'] }}　様</h1>
            <nav class="owner_link_area">
                <ul>
                    <li><a href="/owner/news_input" class="news_input_btn">ニュース入力画面</a></li>
                    <li><a href="/owner/logout" class="logout_btn">ログアウト</a></li>
                </ul>
            </nav>
            
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
    </body>
</html>
