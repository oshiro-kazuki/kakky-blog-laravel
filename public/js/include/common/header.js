{
    'use strict';
    // 使用するタグ
    const header_center_title = get_tag_byId('header_center_title');
    const header_menu_btn = get_tag_byId('header_menu_btn');
    const header_menu_mask = get_tag_byId('header_menu_mask');
    const header_menu_open = get_tag_byId('header_menu_open');
    const header_menu_close = get_tag_byId('header_menu_close');
    const header_menubar_list = get_tag_byId('header_menubar_list');
    const body_tag = get_tag_query('body');
    const header_tag = get_tag_query('header');
    const header_menubar = get_tag_query('.header_menubar');
    
    // タイトル操作
    const title_text = header_center_title.textContent;
    let title_count = 0;
    const title_time = setInterval(() => {
        header_center_title.textContent = title_text.slice(0, title_count +1);
    
        title_count++;
        if(title_count > title_text.length -1) {
            clearInterval(title_time);
        }
    }, 200);
    
    // メニューボタンの表示切り替え
    let header_menu_flg = true; //ヘッダーメニュー表示制御フラグ
    
    // メニューバーボタンクリック
    header_menu_btn.addEventListener('click', () => {
        header_menu_flg ? menubar_open() : menubar_close();
    });
    
    // メニュークローズボタンクリック
    header_menu_mask.addEventListener('click', () => {
        menubar_close();
    });
    
    // 標準タグ
    const menubar_tag_open = [
        header_menu_open,
        header_tag,
        header_center_title,
    ];
    
    // ヘッダーメニュー表示タグ
    const menubar_tag_close = [
        header_menu_close,
        header_menu_mask,
        header_menubar
    ];
    
    // メニューバー表示
    const menubar_open = () => {
        header_menu_flg = !header_menu_flg;
        for(let i = 0; i < menubar_tag_open.length; i++) {
            cla_add(menubar_tag_open[i], 'hidden');
        }
        for(let i = 0; i < menubar_tag_close.length; i++) {
            cla_remove(menubar_tag_close[i], 'hidden');
        }
        const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        cla_add(body_tag, 'fixed', 'top', -scrollTop);
    }
    
    // メニューバー非表示
    const menubar_close = () => {
        header_menu_flg = !header_menu_flg;
        for(let i = 0; i < menubar_tag_open.length; i++) {
            cla_remove(menubar_tag_open[i], 'hidden');
        }
        for(let i = 0; i < menubar_tag_close.length; i++) {
            cla_add(menubar_tag_close[i], 'hidden')
        }
        cla_remove(body_tag, 'fixed', 'top', 0);
    }
}