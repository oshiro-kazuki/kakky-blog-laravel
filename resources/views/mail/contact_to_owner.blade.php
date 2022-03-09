@extends('mail.index')
@section('content')
{{ $postData['contact_mail_name'] }}　様より<br>
<br>
以下の内容でお問い合わせを受け付けました。<br>
<br>
- メールアドレス -<br>
{{ $postData['contact_mail_email'] }}<br>
<br>
- 件名 -<br>
{{ $postData['contact_mail_subject_list'] }}<br>
<br>
- お問い合わせ内容 -<br>
{{ $postData['contact_mail_content'] }}<br>
@endsection