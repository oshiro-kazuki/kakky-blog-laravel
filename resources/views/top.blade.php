<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>wan-like</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    </head>
    <body>
        <header>
            <a href="/" class="header_left">
                <img src="/img/logo.png">
            </a>
            <!-- <a href="/" class="header_center">
                <div id="header_center_title"></div>
            </a> -->
            <div class="header_center">
                <a href="/" id="header_center_title"></a>
            </div>
            <div class="header_right" id="header_menu_btn">
                <span class="material-icons" id="header_menu_open">menu</span>
                <span class="material-icons hidden" id="header_menu_close">close</span>
            </div>
        </header>
        <div id="header_menu_mask" class="hidden"></div>
        <div class="header_menubar hidden">
            <nav>
                <ul id="header_menubar_list"></ul>
            </nav>
        </div>
        <script src="{{ asset('js/common/dom_ operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
    </body>
</html>
