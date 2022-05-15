@extends('mail.index')
@section('content')
@if($owner_flg)
    @if(is_null($name))
        匿名希望
    @else
        {{ $name }}
    @endif
     様よりブログへのコメント受付いたしました。<br>
    <br>
    ご確認をよろしくお願いいたします。
    <br>
@else
    ブログへのコメントありがとうございました。<br>
    <br>
    確認に少々お時間をいただきますので、いましばらくお待ちいただけますよう
    お願い申し上げます。
    <br>
@endif

<br>
コメント内容<br>
{{ $comment }}<br>
<br>

コメントいただいたブログ<br>
{{ $url }}<br>
@endsection