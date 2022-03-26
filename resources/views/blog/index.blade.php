<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}}</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        @if(isset($breadcrumb))
            <link rel="stylesheet" href="{{ asset($breadcrumb) }}">
        @endif
        @if(isset($blog_css))
            <link rel="stylesheet" href="{{ asset($blog_css) }}">
        @endif
    </head>
    <body>
        @include('include.common.header')

        <main>
            @yield('content')
            @include('include.button.top_btn')
        </main>

        @include('include.common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
    </body>
</html>
