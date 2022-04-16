<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.common.meta')
        <title>{{ $title }}</title> 
        @if(isset($ogp))
            @include('include.common.open_graph_protocol')
        @endif

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        @if(isset($breadcrumb))
            <link rel="stylesheet" href="{{ asset($breadcrumb) }}">
        @endif
        @if(isset($blog_css))
            <link rel="stylesheet" href="{{ asset($blog_css) }}">
        @endif

        @include('include.common.google')
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
