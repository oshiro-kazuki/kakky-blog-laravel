<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} : オーナー様</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/form/form.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/button/top_page_btn.css') }}">
    </head>
    <body>
        @include('common.header')

        <main>
            <h1>{{$screen_title}}</h1>
            @yield('content')
        </main>

        <aside>
            <div id="top_page_btn">
                <a href="/">トップ画面へ</a>
            </div>
        </aside>

        @include('common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/component/contents/form.js') }}"></script>
        <script src="{{ asset($script[0]) }}"></script>
    </body>
</html>
