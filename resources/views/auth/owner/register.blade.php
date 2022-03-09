@extends('auth.index')
@section('content')
<article>
    <form action="{{ route('owner.register') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section id="register_input" class="form_section">
            <h2>
                <span class="material-icons">grade</span>
                入力画面
                <span class="material-icons">grade</span>
            </h2>

            <div class="form_list">
                <label>会社または店舗名<span>(必須)</span></label>
                <input id="input_name" type="text" name="company_name" maxlength="{{config('const.INPUT_TEXT_LENGTH')}}" value="{{ old('company_name') }}" placeholder="商号または屋号を入力">
                <p id="form_name_error">@if ($errors->has('company_name'))
                        @foreach ($errors->get('company_name') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>住所<span>(必須)</span></label>
                <input id="input_address" type="text" name="address" maxlength="{{config('const.MAX_LENGTH')}}" value="{{ old('address') }}" placeholder="都道府県から入力">
                <p id="form_address_error">@if ($errors->has('address'))
                        @foreach ($errors->get('address') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>電話番号<span>(必須)</span></label>
                <input id="input_tel" type="tel" name="tel" maxlength="{{config('const.TEL_LENGTH')}}" value="{{ old('tel') }}" placeholder="ハイフン「-」なしで入力">
                <p id="form_tel_error">@if ($errors->has('tel'))
                        @foreach ($errors->get('tel') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>メールアドレス<span>(必須)</span></label>
                <input id="input_email" type="email" name="email" maxlength="{{config('const.MAX_LENGTH')}}" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                <p id="form_email_error">@if ($errors->has('email'))
                        @foreach ($errors->get('email') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>プロフィール、コメント</label>
                <textarea id="input_profile" name="profile" maxlength="{{config('const.INPUT_TEXT_LENGTH')}}" placeholder="プロフィールやアピールポイントを入力、最大{{config('const.INPUT_TEXT_LENGTH')}}文字">{{ old('profile') }}</textarea>
                <p id="form_profile_error">@if ($errors->has('profile'))
                        @foreach ($errors->get('profile') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>プロフィール画像<span>(3MB以内)</span></label>
                <div class="profile_image_click">画像を選択
                    <input id="input_profile_image" class="form_image" type="file" name="image">
                </div>
                <div class="profile_image_del_click">
                    <a href="javascript:void(0)" class="form_del_image_btn hidden" id="form_del_image_btn">画像を削除</a>
                </div>
                <p id="form_profile_image_error">@if ($errors->has('image'))
                        @foreach ($errors->get('image') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>パスワード<span>(必須)</span></label>
                <input id="input_password" type="password" name="password" maxlength="{{config('const.PASSWORD_LENGTH')}}" placeholder="A~Zと.?_を含む半角英数字を入力">
                <p id="form_password_error">@if ($errors->has('password'))
                        @foreach ($errors->get('password') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_list">
                <label>パスワード(確認用)</label>
                <input id="password_confirmation" type="password" name="password_confirmation" maxlength="{{config('const.PASSWORD_LENGTH')}}" placeholder="同じパスワードを入力">
                <p id="form_password_conf_error">@if ($errors->has('password_confirmation'))
                        @foreach ($errors->get('password_confirmation') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <div class="form_conf_submit">
                <a id="register_input_conf_btn" class="form_conf_submit_btn hidden" href="javascript:void(0)">確認</a>
            </div>
        </section>
        <section id="register_conf" class="form_section hidden">
            <h2>
                <span class="material-icons">grade</span>
                登録内容の確認
                <span class="material-icons">grade</span>
            </h2>

            <div class="conf_list">
                <label>会社または店舗名</label>
                <p id="conf_name"></p>
            </div>

            <div class="conf_list">
                <label>住所</label>
                <p id="conf_address"></p>
            </div>

            <div class="conf_list">
                <label>電話番号</label>
                <p id="conf_tel"></p>
            </div>

            <div class="conf_list">
                <label>メールアドレス</label>
                <p id="conf_email"></p>
            </div>

            <div class="conf_list">
                <label>プロフィール、コメント</label>
                <p id="conf_profile">-</p>
            </div>

            <div class="conf_list" id="conf_image">
                <label>プロフィール画像</label>
                <p>-</p>
            </div>

            <div class="conf_list">
                <label>パスワード</label>
                <p>パスワードは表示しておりません。</p>
            </div>

            <div class="form_submit">
                <button id="submit_btn" class="form_submit_btn" type="submit" disabled>新規登録</button>
            </div>

           <div class="form_return">
                <a id="form_return_btn" href="javascript:void(0)">戻る</a>
            </div>
        </section>
    </form>
</article>
<section class="form_link">
    <a href="/owner/login">ログインはこちら</a>
</section>
@endsection