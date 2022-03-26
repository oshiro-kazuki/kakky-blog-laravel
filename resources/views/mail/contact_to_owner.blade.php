@extends('mail.index')
@section('content')
以下の内容でお問い合わせを受け付けました。<br>
<br>
- お客様 -<br>
{{ $postData['name'] }}　様<br>
<br>
- メールアドレス -<br>
{{ $postData['email'] }}<br>
<br>
- 件名 -<br>
{{ $postData['is_subject'] }}<br>
<br>
- お問い合わせ内容 -<br>
{{ $postData['content'] }}<br>
@endsection