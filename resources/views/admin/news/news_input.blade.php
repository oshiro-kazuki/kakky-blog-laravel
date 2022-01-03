<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>wan-like : NEWS投稿</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/news/news_input.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/button/top_page_btn.css') }}">
    </head>
    <body>
        @include('common.header')

        <article class="news_input_form">
            <h1>ニュース投稿画面</h1>
            <form action="{{ route('news_input.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <section id="news_input_form_input">
                    <h2>
                        <span class="material-icons">grade</span>
                        内容の入力
                        <span class="material-icons">grade</span>
                    </h2>
                    <div class="news_input_title">
                        <label>タイトル</label>
                        <input id="news_input_title" type="text" name="news_input_title" maxlength="20" value="{{ old('news_input_title') }}" placeholder="タイトルを入力してください(最大20文字)">
                        <p id="news_input_title_error">
                            @if ($errors->has('news_input_title'))
                                @foreach ($errors->get('news_input_title') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="news_input_content">
                        <label>本文</label>
                        <textarea id="news_input_content" type="text" name="news_input_content" maxlength="140" size="140" cols="30" rows="10" value="{{ old('news_input_content') }}" placeholder="本文を入力してください(最大140文字)"></textarea>
                        <p id="news_input_content_error">
                            @if ($errors->has('news_input_content'))
                                @foreach ($errors->get('news_input_content') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="news_input_confirm_submit">
                        <a id="news_input_confirm_btn" href="javascript:void(0)" class="hidden">確認</a>
                    </div>
                </section>
                <section id="news_input_form_confirm" class="hidden">
                    <h2>
                        <span class="material-icons">grade</span>
                        内容の確認
                        <span class="material-icons">grade</span>
                    </h2>
                    <div class="news_input_title_confirm">
                        <label>タイトル</label>
                        <p id="news_input_title_confirm_text"></p>
                    </div>
                    <div class="news_input_content_confirm">
                        <label>本文</label>
                        <p id="news_input_content_confirm_text"></p>
                    </div>
                    <div class="news_input_submit">
                        <button id="news_input_submit_btn" type="submit" disabled>投稿</button>
                    </div>
                    <div class="news_input_return">
                        <a id="news_input_return_btn" href="javascript:void(0)">戻る</a>
                    </div>
                </section>
            </form>
        </article>
        <aside>
            <div id="top_page_btn"></div>
        </aside>

        @include('common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/news/news_input.js') }}"></script>
        <script src="{{ asset('js/component/button/top_page_btn.js') }}"></script>
    </body>
</html>
