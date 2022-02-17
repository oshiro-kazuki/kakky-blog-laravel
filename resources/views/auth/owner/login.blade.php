@extends('auth.owner.index')
@section('content')
<article>
    <form action="{{ route('ownerLogin') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section class="form_list">
            <label>メールアドレス</label>
            <input id="login_email" type="email" name="login_email" maxlength="191" placeholder="メールアドレスを入力">
            <p id="login_email_error">@if ($errors->has('login_email'))
                    @foreach ($errors->get('login_email') as $detail_errors)
                        {{$detail_errors}}
                    @endforeach
                @endif</p>
        </section>
        <section class="form_list">
            <label>パスワード</label>
            <input id="login_password" type="password" name="login_password" maxlength="20" placeholder="パスワードを入力">
            <p id="login_password_error">@if ($errors->has('login_password'))
                    @foreach ($errors->get('login_password') as $detail_errors)
                        {{$detail_errors}}
                    @endforeach
                @endif</p>
        </section>
        <section class="form_submit">
            <button id="login_submit" class="form_submit_btn" type="submit" disabled>ログイン</button>
        </section>
    </form>
</article>
<section class="form_link">
    <a href="/owner/register">新規登録はこちら</a>
</section>
@endsection
