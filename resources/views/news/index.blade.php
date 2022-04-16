<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.common.meta')
        <title>{{ $title }}</title>
        @if(isset($ogp))
            @include('include.common.open_graph_protocol')
        @endif

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/news/news.css') }}">

        @include('include.common.google')
    </head>
    <body>
        @include('include.common.header')
        <main>
            <h1>ニュース一覧画面</h1>
            <article>
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
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
    </body>
</html>
