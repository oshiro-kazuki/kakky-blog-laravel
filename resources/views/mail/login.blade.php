@extends('mail.index')
@section('content')
{{ $os }} デバイスで、ログインが検出されました。<br>
ご自身によるものであれば、何もする必要はありません。ログインに心当たりがない場合は、アカウントを保護していただけるようサポートします。<br>
<br>
お問い合わせはこちら<br>
{{ $contact_url }}<br>
<br>
@endsection