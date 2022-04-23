<?php
    $footer_menu_list = array(
        ['text'=> 'プロフィール'        , 'link'=> '/profile'],
        ['text'=> 'お問い合わせ'        , 'link'=> '/contact_mail'],
        ['text'=> 'プライバシーポリシー'  , 'link'=> '/privacy_policy'],
    );

    $footer_sns_list = array(
        ['logo'=> '/img/sns/twitter_logo.png'   , 'link'=> 'https://twitter.com/okkk_19'],
    );
?>

<footer>
    <div class="footer_menu_list">
        <nav>
            <ul id="footer_list">
                @foreach ($footer_menu_list as $list)
                <li class="footer_list_li hidden"><a href="{{$list['link']}}">{{$list['text']}}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="footer_sns_list">
        <nav>
            <ul id="footer_sns">
                @foreach ($footer_sns_list as $list)
                <li><a href="{{$list['link']}}"><img src="{{$list['logo']}}" class="footer_sns_logo" onerror="this.onerror=null;this.src='/img/nophoto.png';" alt="snsのロゴ画像" loading="lazy"></a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</footer>