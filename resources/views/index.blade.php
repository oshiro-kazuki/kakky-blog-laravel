<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}}</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('css/include/contents/news.css') }}"> -->
    </head>
    <body>
        @include('include.common.header')
        <main>
            <section id="top_image" class="top_image"></section>
            <!-- @if(count($news_lists) > 0)
                @include('include.contents.news')
            @endif -->
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
        <script src="{{ asset('js/top_image.js') }}"></script>
        <!-- <script src="{{ asset('js/include/contents/carousel.js') }}"></script> -->
    </body>
</html>
