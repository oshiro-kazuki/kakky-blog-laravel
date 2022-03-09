@extends('mail.index')
@section('content')
メールアドレスの検証を行うため下記のボタンをクリックしてください。<br>
<br>
{{ $url }}<br>
<br>
心当たりのない場合は不要です。<br>
@endsection