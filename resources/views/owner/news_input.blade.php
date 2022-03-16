<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} : NEWS投稿</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/form/form.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            <h1>ニュース投稿画面</h1>
            <form action="{{ route('news_input.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <section id="input_section" class="form_section">
                    <h2>
                        <span class="material-icons">grade</span>
                        入力画面
                        <span class="material-icons">grade</span>
                    </h2>
                    <div class="form_list">
                        <label>タイトル</label>
                        <input id="input_title" type="text" name="title" maxlength="20" value="{{ old('title') }}" placeholder="タイトルを入力(最大20文字)">
                        <p id="title_error">
                            @if ($errors->has('title'))
                                @foreach ($errors->get('title') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="form_list">
                        <label>本文</label>
                        <textarea id="input_content" type="text" name="content" maxlength="140" size="140" cols="30" rows="10" placeholder="本文を入力(最大140文字)">{{ old('content') }}</textarea>
                        <p id="content_error">
                            @if ($errors->has('content'))
                                @foreach ($errors->get('content') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div id="form_conf_btn" class="form_conf_btn hidden">確認</div>
                </section>
                <section id="conf_section" class="form_section hidden">
                    <h2>
                        <span class="material-icons">grade</span>
                        確認画面
                        <span class="material-icons">grade</span>
                    </h2>
                    <div class="conf_list">
                        <label>タイトル</label>
                        <p id="conf_title"></p>
                    </div>
                    <div class="conf_list">
                        <label>本文</label>
                        <p id="conf_content"></p>
                    </div>
                    <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
                    <div id="form_return_btn" class="form_return_btn">戻る</div>
                </section>
            </form>
            @include('include.button.owner_btn')
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/component/contents/form.js') }}"></script>
        <script src="{{ asset('js/owner/news_input.js') }}"></script>
    </body>
</html>
