@extends('mail.index')
@section('content')
{{ $postData['name'] }}　様<br>
<br>
お問い合わせをいただき、誠にありがとうございます。<br>
以下の内容で受け付けいたしました。<br>
ご確認に少々お時間をいただきます。<br>
大変恐縮ではございますが、今しばらくお待ちください。<br>
<br>
- 件名 -<br>
{{ $postData['is_subject'] }}<br>
<br>
- お問い合わせ内容 -<br>
{{ $postData['content'] }}<br>
@endsection