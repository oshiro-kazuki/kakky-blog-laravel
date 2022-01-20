<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} : NEWS一覧</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/button/top_page_btn.css') }}">
        <link rel="stylesheet" href="{{ asset('css/news/news.css') }}">
    </head>
    <body>
        @include('common.header')

        <article class="news_list">
            <h1>ニュース一覧画面</h1>
            @if(count($news_lists) > 0)
                @foreach ($news_lists as $news_list)
                    <section class="news_item" id="{{$news_list->id}}">
                        <h6>{{$news_list->created_at_date}}</h6>
                        <h3>{{$news_list->title}}</h3>
                        <p>{{$news_list->content}}</p>
                    </section>
                @endforeach
            @else
                <section class="news_item_none">
                    <h6>現在ニュースはありません。</h6>
                </section>
            @endif
        </article>
        <aside>
            <div id="top_page_btn"></div>
        </aside>

        @include('common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/component/button/top_page_btn.js') }}"></script>
    </body>
</html>
