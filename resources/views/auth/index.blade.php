<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.common.meta')
        <title>認証・登録</title>
        <meta name="robots" content="noindex,nofollow">

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth/index.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            @if(isset($screen_title))
                <h1>{{$screen_title}}</h1>
            @endif
            @yield('content')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/common/form.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
        @if(isset($script))
            <script src="{{ asset($script[0]) }}"></script>
        @endif
    </body>
</html>
