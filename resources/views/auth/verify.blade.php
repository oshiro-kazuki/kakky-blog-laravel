@extends('auth.index')
@section('content')
<article>
    <section class="mail_announcement">
        <h6>
            @if (session('resent'))
                新しい認証用メールを送信しました。
            @else
                ご登録されたメールアドレスを確認します。
            @endif
            <br>記載しているリンクへアクセスしてください。
        </h6>
    </section>
    
    <section class="mail_none">
        <p>下のボタンを押してメール送信してください。</p>
    </section>
    <section class="form_submit">
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <input type="hidden" name="user_type" value="{{$user_type}}">
            <button id="form_submit" type="submit" class="form_submit_btn">メール送信</button>.
        </form>
    </section>
</article>
@endsection