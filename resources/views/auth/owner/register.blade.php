@extends('auth.owner.index')
@section('content')
<article>
    <form action="{{ route('ownerRegister') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section id="register_input" class="form_section">
            <h2>
                <span class="material-icons">grade</span>
                入力画面
                <span class="material-icons">grade</span>
            </h2>

            <div class="form_list">
                <label>会社または店舗名<span>(必須)</span></label>
                <input id="input_name" type="text" name="name" maxlength="{{config('const.MAX_LENGTH')}}" value="{{ old('name') }}" placeholder="商号または屋号を入力">
                <p id="form_name_error">
                    @if ($errors->has('name'))
                        @foreach ($errors->get('name') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_list">
                <label>住所<span>(必須)</span></label>
                <input id="input_address" type="text" name="address" maxlength="{{config('const.MAX_LENGTH')}}" value="{{ old('address') }}" placeholder="都道府県から入力">
                <p id="form_address_error">
                    @if ($errors->has('address'))
                        @foreach ($errors->get('address') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_list">
                <label>電話番号<span>(必須)</span></label>
                <input id="input_tel" type="text" name="tel" maxlength="{{config('const.TEL_LENGTH')}}" value="{{ old('tel') }}" placeholder="電話番号を入力">
                <p id="form_tel_error">
                    @if ($errors->has('tel'))
                        @foreach ($errors->get('tel') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_list">
                <label>メールアドレス<span>(必須)</span></label>
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
                <label>プロフィール、コメント</label>
                <textarea id="input_profile" name="profile" maxlength="{{config('const.INPUT_TEXT_LENGTH')}}" placeholder="プロフィールやアピールポイントを入力、最大{{config('const.INPUT_TEXT_LENGTH')}}文字">{{ old('profile') }}</textarea>
                <p id="form_profile_error">
                    @if ($errors->has('profile'))
                        @foreach ($errors->get('profile') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_list">
                <label>プロフィール画像<span>(3MB以内)</span></label>
                <div class="profile_image_click">画像を選択
                    <input id="input_profile_image" class="form_image" type="file" name="profile_image">
                </div>
                <p id="form_profile_image_error">
                    @if ($errors->has('profile_image'))
                        @foreach ($errors->get('profile_image') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_list">
                <label>パスワード<span>(必須)</span></label>
                <h6>※パ8文字以上20文字以内で半角英数字、大文字英字と.?_をどれか必ず入れてください。</h6>
                <input id="input_password" type="password" name="password" maxlength="{{config('const.PASSWORD_LENGTH')}}" value="{{ old('password') }}" placeholder="最大{{config('const.PASSWORD_LENGTH')}}文字">
                <p id="form_password_error">
                    @if ($errors->has('password'))
                        @foreach ($errors->get('password') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_list">
                <label>パスワード(確認用)</label>
                <input id="password_confirmation" type="password" name="password_confirmation" maxlength="{{config('const.PASSWORD_LENGTH')}}" value="{{ old('password_confirmation') }}" placeholder="同じパスワードを入力">
                <p id="form_password_error">
                    @if ($errors->has('password_confirmation'))
                        @foreach ($errors->get('password_confirmation') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>

            <div class="form_conf_submit">
                <a id="register_input_conf_btn" class="form_conf_submit_btn" href="javascript:void(0)">確認</a>
            </div>
        </section>
        <section id="register_conf" class="form_section">
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
                <p id="input_address"></p>
            </div>

            <div class="conf_list">
                <label>電話番号</label>
                <p id="input_tel"></p>
            </div>

            <div class="conf_list">
                <label>メールアドレス</label>
                <p id="input_email"></p>
            </div>

            <div class="conf_list">
                <label>プロフィール、コメント</label>
                <p id="input_profile"></p>
            </div>

            <div class="conf_list">
                <label>プロフィール画像</label>
                <p id="profile_image"></p>
            </div>

            <div class="conf_list">
                <label>パスワード</label>
                <p>パスワードは表示しておりません。</p>
            </div>

            <div class="form_submit">
                <button id="submit_btn" class="form_submit_btn" type="submit">新規登録</button>
            </div>
        </section>
    </form>
</article>
@endsection
