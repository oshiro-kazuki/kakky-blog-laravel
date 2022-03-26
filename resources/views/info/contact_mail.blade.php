<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} : お問い合わせ</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/include/common/footer.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            <form action="{{ route('contact_mail.send') }}" method="post" enctype="multipart/form-data">
                @csrf
                <section id="contact_input" class="form_section">
                    <h2>
                        <span class="material-icons">grade</span>
                            お問い合わせ画面
                        <span class="material-icons">grade</span>
                    </h2>
                    <div class="form_list">
                        <label>お名前</label>
                        <input id="input_name" type="text" name="name" maxlength="{{$text_length}}" value="{{ old('name') }}" placeholder="お名前を入力">
                        <p id="form_name_error">@if ($errors->has('name'))
                                @foreach ($errors->get('name') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif</p>
                    </div>
                    <div class="form_list">
                        <label>メールアドレス</label>
                        <input id="input_email" type="email" name="email" maxlength="{{$max_length}}" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                        <p id="form_email_error">@if ($errors->has('email'))
                                @foreach ($errors->get('email') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif</p>
                    </div>
                    <div class="form_list">
                        <label>件名</label><br>
                        <div class="form_select_area">
                            <select id="input_subject" name="subject">
                                @foreach ($subject_list as $key => $value)
                                    @if(old('subject') == $value)
                                        <option value="{{$value}}" selected>{{$key}}</option>
                                    @else
                                        <option value="{{$value}}">{{$key}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <p id="input_subject_init" class="form_select_text">選択</p>
                        </div>
                        <p id="form_subject_error">@if ($errors->has('subject'))
                                @foreach ($errors->get('subject') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif</p>
                    </div>
                    <div class="form_list">
                        <label>お問い合わせ内容</label>
                        <textarea id="input_content" name="content" cols="30" rows="10" maxlength="{{$text_length}}" placeholder="お問い合わせ内容を入力">{{ old('content') }}</textarea>
                        <p id="form_content_error">@if ($errors->has('content'))
                                @foreach ($errors->get('content') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif</p>
                    </div>
                    <div id="form_conf_btn" class="form_conf_btn hidden">確認</div>
                </section>
                <section id="contact_conf" class="form_section hidden">
                    <h2>
                        <span class="material-icons">grade</span>
                            お問い合わせの確認
                        <span class="material-icons">grade</span>
                    </h2>
                    <div class="conf_list">
                        <label>お名前</label>
                        <p id="conf_name"></p>
                    </div>
                    <div class="conf_list">
                        <label>メールアドレス</label>
                        <p id="conf_email"></p>
                    </div>
                    <div class="conf_list">
                        <label>件名</label>
                        <p id="conf_subject"></p>
                    </div>
                    <div class="conf_list">
                        <label>お問い合わせ内容</label>
                        <p id="conf_content"></p>
                    </div>
                    <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
                    <div id="form_return_btn" class="form_return_btn">戻る</div>
                </section>
            </form>
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/common/form.js') }}"></script>
        <script src="{{ asset('js/include/common/header.js') }}"></script>
        <script src="{{ asset('js/include/common/footer.js') }}"></script>
        <script src="{{ asset('js/info/contact.js') }}"></script>
    </body>
</html>
