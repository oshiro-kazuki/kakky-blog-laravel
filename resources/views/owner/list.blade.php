<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.common.meta')
        @if(isset($screen_title))
            <title>{{ $screen_title }}</title>
        @else
            <title>{{ config('const.APP_NAME') }}</title>
        @endif

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        @if(isset($blog_css))
            <link rel="stylesheet" href="{{ asset($blog_css) }}">
        @endif
        @if(isset($blog_css_owner))
            <link rel="stylesheet" href="{{ asset($blog_css_owner) }}">
        @endif
        @if(isset($blog_comment))
            <link rel="stylesheet" href="{{ asset('css/owner/blog_comment_list.css') }}">
        @endif
    </head>
    <body>
        @include('include.common.header')
        <main>
            @if(isset($screen_title))
                <h1>{{$screen_title}}</h1>
            @endif
            @yield('content')
            @include('include.button.owner_btn')
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
    </body>
</html>
