<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} : お問い合わせ</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/form/form.css') }}">
        <link rel="stylesheet" href="{{ asset('css/info/contact.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/button/top_page_btn.css') }}">
    </head>
    <body>
        @include('common.header')

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
                        <input id="input_name" type="text" name="name" maxlength="{{config('const.INPUT_TEXT_LENGTH')}}" value="{{ old('name') }}" placeholder="お名前を入力">
                        <p id="form_name_error">
                            @if ($errors->has('name'))
                                @foreach ($errors->get('name') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="form_list">
                        <label>メールアドレス</label>
                        <input id="input_email" type="email" name="email" maxlength="{{config('const.MAX_LENGTH')}}" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                        <p id="form_email_error">
                            @if ($errors->has('email'))
                                @foreach ($errors->get('email') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="form_list">
                        <label>件名</label><br>
                        <div class="form_select_area">
                            <select id="input_subject" name="subject">
                                @foreach ($subject_list as $key => $value)
                                    <option value="{{$value}}">{{$key}}</option>
                                @endforeach
                            </select>
                            <p id="input_subject_init" class="form_select_text">要件を選択</p>
                        </div>
                        <p id="form_subject_error">
                            @if ($errors->has('subject'))
                                @foreach ($errors->get('subject') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="form_list">
                        <label>お問い合わせ内容</label>
                        <textarea id="input_content" name="content" cols="30" rows="10" maxlength="{{config('const.INPUT_TEXT_LENGTH')}}" placeholder="お問い合わせ内容を入力">{{ old('content') }}</textarea>
                        <p id="form_content_error">
                            @if ($errors->has('content'))
                                @foreach ($errors->get('content') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="form_conf_submit">
                        <a id="contact_input_conf_btn" href="javascript:void(0)" class="form_conf_submit_btn hidden">確認</a>
                    </div>
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
                    <div class="form_submit">
                        <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
                    </div>
                    <div class="form_return">
                        <a id="form_return_btn" href="javascript:void(0)">戻る</a>
                    </div>
                </section>
            </form>
        </main>
        <aside>
            <div id="top_page_btn"></div>
        </aside>

        @include('common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/component/contents/form.js') }}"></script>
        <script src="{{ asset('js/info/contact.js') }}"></script>
        <script src="{{ asset('js/component/button/top_page_btn.js') }}"></script>
    </body>
</html>
