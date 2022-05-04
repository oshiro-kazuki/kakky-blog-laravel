<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.common.meta')
        <title>エラー</title>
        <meta name="robots" content="noindex,nofollow">

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            <h1 style="text-align:center;font-weight:800;font-size:1.5rem;">エラー画面</h1>
            @yield('content')
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
    </body>
</html>
