<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.common.meta')
        <title>オーナー画面</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owner/index.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            <h1>{{ $owner['name'] }}  様</h1>
            <nav class="owner_link_area">
                <ul>
                    <!-- <li><a href="/owner/news_input" class="owner_content_btn">ニュース入力画面</a></li> -->
                    <li><a href="/owner/blog/blog_input" class="owner_content_btn">ブログ入力画面</a></li>
                    <li><a href="/owner/blog" class="owner_content_btn">ブログ一覧画面</a></li>
                    <li><a href="/owner/blog_comment" class="owner_content_btn">ブログコメント一覧画面</a></li>
                    <li><a href="/owner/logout" class="btn close_btn">ログアウト</a></li>
                </ul>
            </nav>
            
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
    </body>
</html>
