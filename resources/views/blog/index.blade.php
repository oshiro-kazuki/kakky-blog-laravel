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
        <link rel="stylesheet" href="{{ asset('css/include/common/breadcrumb.css') }}">
        @if(isset($blog_css))
            <link rel="stylesheet" href="{{ asset($blog_css) }}">
        @endif
        @if(isset($search_flg) && $search_flg)
            <link rel="stylesheet" href="{{ asset('css/blog/search.css') }}">
        @endif
        @if(isset($chat))
            <link rel="stylesheet" href="{{ asset($chat['css']) }}">
        @endif

        @include('include.common.google')
    </head>
    <body>
        @include('include.common.header')

        @include('include.common.breadcrumb')
        
        <main>
            @yield('content')
            @include('include.button.top_btn')
        </main>

        @include('include.common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
        @if(isset($search_flg) && $search_flg)
            <script src="{{ asset('js/blog/search.js') }}"></script>
        @endif
        @if(isset($detail_js))
            <script src="{{ asset($detail_js[0]) }}"></script>
        @endif
        @if(isset($chat))
            <script src="{{ asset('js/common/validation.js') }}"></script>
            <script src="{{ asset($chat['js']) }}"></script>
        @endif
    </body>
</html>