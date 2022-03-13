<?php
    $header_menu_list = array(
        ['text'=> 'ブログ'     , 'link'=> 'https=>//kakky-blog.com', 'icon'=> 'article'],
        ['text'=> 'お問い合わせ', 'link'=> '/info/contact_mail/'    , 'icon'=> 'email'],
        ['text'=> 'プロフィール', 'link'=> '/info/profile/'         , 'icon'=> 'person'],
    );
?> 

<header>
    <a href="/" class="header_left">
        <img src="/img/logo.png" alt="ロゴ画像">
    </a>
    <div class="header_center">
        <a href="/" id="header_center_title">{{config('const.APP_NAME')}}</a>
    </div>
    <div class="header_right" id="header_menu_btn">
        <span class="material-icons" id="header_menu_open">menu</span>
        <span class="material-icons hidden" id="header_menu_close">close</span>
    </div>
</header>
<div id="header_menu_mask" class="hidden"></div>
<div class="header_menubar hidden">
    <nav>
        <ul id="header_menubar_list">
            @foreach ($header_menu_list as $list)
            <li><a href="{{$list['link']}}"><span class="material-icons">{{$list['icon']}}</span><p>{{$list['text']}}</p></a></li>
            @endforeach
        </ul>
    </nav>
</div>