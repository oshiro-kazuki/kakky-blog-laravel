<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>wan-like : お問い合わせ</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/info/contact.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/button/top_page_btn.css') }}">
    </head>
    <body>
        @include('common.header')

        <div class="contact_mail_form">
            <form action="{{ route('contact_mail.send') }}" method="post" enctype="multipart/form-data">
                @csrf
                <section id="contact_mail_form_input">
                    <div class="contact_mail_name">
                        <label>お名前</label>
                        <input id="contact_mail_name" type="text" name="contact_mail_name" size="40" value="{{ old('contact_mail_name') }}" placeholder="お名前を入力してください">
                        <p id="contact_mail_name_error">
                            @if ($errors->has('contact_mail_name'))
                                @foreach ($errors->get('contact_mail_name') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="contact_mail_email">
                        <label>メールアドレス</label>
                        <input id="contact_mail_email" type="email" name="contact_mail_email" size="100" value="{{ old('contact_mail_email') }}" placeholder="メールアドレスを入力してください">
                        <p id="contact_mail_email_error">
                            @if ($errors->has('contact_mail_email'))
                                @foreach ($errors->get('contact_mail_email') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="contact_mail_subject">
                        <label>件名</label><br>
                        <div class="contact_mail_subject_select_area">
                            <select id="contact_mail_subject" name="contact_mail_subject"></select>
                            <p id="contact_mail_subject_init">- 選択してください -</p>
                            <span class="material-icons">pan_tool_alt</span>
                        </div>
                        <p id="contact_mail_subject_error">
                            @if ($errors->has('contact_mail_subject'))
                                @foreach ($errors->get('contact_mail_subject') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="contact_mail_content">
                        <label>お問い合わせ内容</label>
                        <textarea id="contact_mail_content" name="contact_mail_content" cols="30" rows="10" placeholder="お問い合わせ内容を入力してください">{{ old('contact_mail_content') }}</textarea>
                        <p id="contact_mail_content_error">
                            @if ($errors->has('contact_mail_content'))
                                @foreach ($errors->get('contact_mail_content') as $detail_errors)
                                    {{$detail_errors}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="contact_mail_input_submit">
                        <a id="contact_mail_input_submit_btn" href="javascript:void(0)" class="hidden">確認</a>
                    </div>
                </section>
                <section id="contact_mail_form_confirm" class="hidden">
                    <h1>
                        <span class="material-icons">grade</span>
                        内容の確認
                        <span class="material-icons">grade</span>
                    </h1>
                    <div class="contact_mail_name_confirm">
                        <label>お名前</label>
                        <p id="contact_mail_name_confirm_text"></p>
                    </div>
                    <div class="contact_mail_email_confirm">
                        <label>メールアドレス</label>
                        <p id="contact_mail_email_confirm_text"></p>
                    </div>
                    <div class="contact_mail_subject_confirm">
                        <label>件名</label>
                        <p id="contact_mail_subject_confirm_text"></p>
                    </div>
                    <div class="contact_mail_content_confirm">
                        <label>お問い合わせ内容</label>
                        <p id="contact_mail_content_confirm_text"></p>
                    </div>
                    <div class="contact_mail_submit">
                        <button id="contact_mail_submit_btn" type="submit" disabled>送信</button>
                    </div>
                    <div class="contact_mail_return">
                        <a id="contact_mail_return_btn" href="javascript:void(0)">戻る</a>
                    </div>
                </section>
                <input id="contact_mail_subject_list" name="contact_mail_subject_list" type="hidden">
            </form>
        </div>
        <aside>
            <div id="top_page_btn"></div>
        </aside>

        @include('common.footer')

        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
        <script src="{{ asset('js/common/validation.js') }}"></script>
        <script src="{{ asset('js/info/contact.js') }}"></script>
        <script src="{{ asset('js/component/button/top_page_btn.js') }}"></script>
    </body>
</html>
