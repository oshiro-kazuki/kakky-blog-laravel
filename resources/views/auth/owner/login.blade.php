@extends('auth.index')
@section('content')
<article>
    <form action="{{ route('owner.login') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_type" value="owner">
        <section class="form_list">
            <label>メールアドレス</label>
            <input id="login_email" type="email" name="email" maxlength="{{$max_length}}" placeholder="メールアドレスを入力">
            <p id="login_email_error">@if ($errors->has('email'))
                    @foreach ($errors->get('email') as $detail_errors)
                        {{$detail_errors}}
                    @endforeach
                @endif</p>
        </section>
        <section class="form_list">
            <label>パスワード</label>
            <input id="login_password" type="password" name="password" maxlength="{{$pw_length}}" placeholder="パスワードを入力">
            <p id="login_password_error">@if ($errors->has('password'))
                    @foreach ($errors->get('password') as $detail_errors)
                        {{$detail_errors}}
                    @endforeach
                @endif</p>
        </section>
        <section class="form_submit">
            <button id="login_submit" class="form_submit_btn" type="submit" disabled>ログイン</button>
        </section>
    </form>
    <section class="form_link">
        <a href="/owner/register">新規登録はこちら</a>
    </section>
</article>
@endsection
