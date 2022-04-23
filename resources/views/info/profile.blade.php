@extends('info.index')
@section('content')
<article>
    <div class="profile_main_image">
        <img src="/img/info/profile/profile.jpg" onerror="this.onerror=null;this.src='/img/nophoto.png';">
    </div>
</article>
<article>
    <section class="profile_career">
        <h3>略歴</h3>
        <ul>
            <li><p>税理士事務所</p><span>11年</span></li>
            <li><p>webエンジニア(現在)</p><span>2年</span></li>
        </ul>
    </section>
    <section class="profile_area">
        <h3>拠点</h3>
        <ul>
            <li><p>沖縄県</p></li>
        </ul>
    </section>
    <section class="profile_comment">
        <h3>コメント</h3>
        <p>初めまして。<br>koと申します。<br>webエンジニアになって2年目になります。<br>長年勤めた税理士事務所では税金を通してお客様の課題を解決し喜ばれることにとてもやりがいを感じておりました。<br>現在は自身が開発したアプリケーションで皆様に貢献できたらと思い、日々精進しております。<br>ホームページの作成やアプリケーションの開発のことで、ご依頼・ご相談があれば是非ご連絡をよろしくお願いいたします。</p>
    </section>
</article>
@include('include.button.contact_btn')
@endsection