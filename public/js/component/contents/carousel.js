'use strict';
window.addEventListener('load', () =>{
    const btn_view_flg = true;
    // カルーセルの要素指定
    const carousel_items_container = get_tag_query('.carousel_items_container');
    const carousel_items = document.querySelectorAll('.carousel_item');
    
    if(carousel_items_container){
        const carousel_items_container_ul = get_tag_query('.carousel_items_container ul');

        if(carousel_items.length > 0){
            // 表示領域でカルーセル発火
            const carousel_options = {
                root: null,
                rootMargin: '0px',
                threshold: 0
            }
            
            function carousel_callback(entries, object){
                if(entries[0].isIntersecting){
                    carouselView();
                    object.unobserve(entries[0].target);
                }
            }
        
            const dot_btn_observer = new IntersectionObserver(carousel_callback, carousel_options);
            dot_btn_observer.observe(carousel_items_container);

            function carouselView(){
                let current_index               = 1;    // カルセールの表示アイテムインデックス
                const carousel_item_margin      = 10;   // カルーセルのアイテムのスタイル指定
                const carousel_container_space  = 20;
                const carousel_dot_btns_width   = 150;
                const carousel_dotbtn_size      = 10;
    
                // アイテム毎にスタイル設定
                carousel_items.forEach((item) => {
                    item.style.float = 'left';
                    item.style.marginRight = `${carousel_item_margin}px`;
                    item.style.marginLeft = `${carousel_item_margin}px`;
                    currentItemStyle();
                });
    
                //　カルーセルのコンテナをアイテム数に合わせて幅計算
                const carousel_item_width = carousel_items[0].offsetWidth + carousel_item_margin * 2;
                const carousel_container_width = carousel_item_width * carousel_items.length;
    
                // カルーセルのアイテム親要素スタイル指定
                carousel_items_container_ul.style.position = 'relative';
                carousel_items_container_ul.style.height = `${carousel_items_container.clientHeight - carousel_item_margin}px`;
                carousel_items_container_ul.style.overflow = 'hidden';
                carousel_items_container_ul.style.transitionProperty = 'left';
                carousel_items_container_ul.style.transitionDuration = '.5s';
                carousel_items_container_ul.style.transitionTimingRunction = 'ease-out';
                carousel_items_container_ul.style.width = `${carousel_container_width}px`;
                carousel_items_container_ul.style.paddingTop = `10px`;
    
                // カルーセルアイテムの表示位置指定
                const carousel_item_start = (window.innerWidth - carousel_item_width) / 2;
                carousel_items_container_ul.style.left = `${carousel_item_start}px`;
    
    
                // スワイプイベント
                let start_x         = 0;
                let end_x           = 0;
                let end_y           = 0;
                let swipe_x         = 0;
                const swiper_limit  = 50;
                
                function logSwipeStart(event) {
                    event.preventDefault();
                    start_x = event.touches[0].pageX;
                }
                
                function logSwipe(event) {
                    event.preventDefault();
                    end_x = event.touches[0].pageX;
                    end_y = event.touches[0].pageY;
                }
                
                function logSwipeEnd(event) {
                    event.preventDefault();
                    swipe_x = end_x - start_x;
    
                    if(swipe_x > swiper_limit && end_x !== 0){
                        prevMove();
                    }else if(swipe_x < -swiper_limit && end_x !== 0){
                        nextMove();
                    }else if(end_x === 0 && end_y === 0){
                        const carousel_item_links = document.querySelectorAll('.carousel_item_link');
                        if(carousel_item_links.length > 0){
                            location.href = carousel_item_links[current_index - 1].href;
                        }
                    }else{
                        return;
                    }
    
                    start_x  = 0;
                    end_x    = 0;
                    end_y    = 0;
                    swipe_x  = 0;
                }
                
                carousel_items_container_ul.addEventListener('touchstart', logSwipeStart);
                
                carousel_items_container_ul.addEventListener('touchmove', logSwipe);
    
                carousel_items_container_ul.addEventListener('touchend', logSwipeEnd);
                
                //　右にスライド処理
                function nextMove(){
                    // カルーセルのコンテナの位置を取得
                    const current_left = carousel_items_container_ul.getBoundingClientRect().x;
                    
                    let move;
                    if(current_index < carousel_items.length){
                        move = current_left - carousel_item_width;
                        current_index++;
                    }else{
                        move = carousel_item_start;
                        current_index = 1;
                    }
                    carousel_items_container_ul.style.left = `${move}px`;
                    currentItemStyle();
                    currentDotbtnStyle()
                }
                
                // 左にスライド処理
                function prevMove(){
                    // カルーセルのコンテナの位置を取得
                    const current_left = carousel_items_container_ul.getBoundingClientRect().x;
                    
                    let move;
                    if(current_index > 1){
                        move = current_left + carousel_item_width;
                        current_index--;
                    }else{
                        move = carousel_item_start - carousel_item_width * (carousel_items.length - 1);
                        current_index = carousel_items.length;
                    }
                    carousel_items_container_ul.style.left = `${move}px`;
                    currentItemStyle();
                    currentDotbtnStyle()
                }

                // カレントアイテムのスタイル設定
                function currentItemStyle(){
                    const default_scale         = 1;    // カルーセルでカレントアイテムのスケール標準値
                    const carousel_item_scale   = 1.05; // カルーセルでカレントアイテムのスケール変動値
    
                    carousel_items.forEach((item, index)=>{
                        if(index === current_index - 1){
                            item.style.transform = `scale(${carousel_item_scale}, ${carousel_item_scale})`;
                        }else{
                            item.style.transform = `scale(${default_scale}, ${default_scale})`;
                        }
                    });
                }

                // ボタンのコンテナスタイル設定
                const carousel_btns_container = create_tag('div', carousel_items_container, false, 'carousel_btns_container')
                carousel_btns_container.style.display           = 'flex';
                carousel_btns_container.style.justifyContent    = 'space-evenly';
                carousel_btns_container.style.height            = `${50}px`;
                carousel_btns_container.style.width             = '100%';
                carousel_btns_container.style.marginTop         = `${carousel_container_space}px`;
                carousel_btns_container.style.marginBottom      = `${carousel_container_space}px`;
                carousel_btns_container.style.paddingRight      = `${carousel_container_space}px`;
                carousel_btns_container.style.paddingLeft       = `${carousel_container_space}px`;

                // ボタンサイズ
                const carousel_btn_size = 50;

                if(carousel_items.length > 1 && btn_view_flg){
                    // 前ボタン生成
                    const carousel_prev_btn = create_tag('div', carousel_btns_container, false, 'carousel_prev_btn');
                    cla_add(carousel_prev_btn, 'material-icons');
                    carousel_prev_btn.textContent = 'arrow_back_ios';
                    carouselBtnStyle(carousel_prev_btn);
                    carousel_prev_btn.style.paddingLeft = '8px';

                    // 前ボタンをクリックでイベント発火
                    carousel_prev_btn.addEventListener('click', () => {
                        prevMove();
                    });
                }

                // ドットボタン配置エリア生成
                const carousel_dotbtn_container = create_tag('div', carousel_btns_container, false, 'carousel_dotbtn_container');;
                carousel_dotbtn_container.style.display         = 'flex';
                carousel_dotbtn_container.style.justifyContent  = 'space-evenly';
                carousel_dotbtn_container.style.alignItems      = 'center';
                carousel_dotbtn_container.style.width           = `${carousel_dot_btns_width}px`;

                if(carousel_items.length > 1 && btn_view_flg){
                    // 次ボタン生成
                    const carousel_next_btn = create_tag('div', carousel_btns_container, false, 'carousel_next_btn');
                    cla_add(carousel_next_btn, 'material-icons');
                    carousel_next_btn.textContent = 'arrow_forward_ios';
                    carouselBtnStyle(carousel_next_btn);

                    // 次ボタンをクリックでイベント発火
                    carousel_next_btn.addEventListener('click', () => {
                        nextMove();
                    });
                }
                
                // ドットボタン生成
                carousel_items.forEach(() => {
                    const dot_btn = create_tag('span', carousel_dotbtn_container, false, 'carousel_dotBtn');
                    dot_btn.style.display           = 'block';
                    dot_btn.style.width             = `${carousel_dotbtn_size}px`;
                    dot_btn.style.height            = `${carousel_dotbtn_size}px`;
                    dot_btn.style.backgroundColor   = '#ccc';
                    dot_btn.style.borderRadius      = '50%';
                });
                
                // カルーセル次と前ボタンのスタイル指定
                function carouselBtnStyle(element){
                    element.style.display       = 'block';
                    element.style.width         = `${carousel_btn_size}px`;
                    element.style.height        = `${carousel_btn_size}px`;
                    element.style.lineHeight    = `${carousel_btn_size- 5}px`;
                    element.style.textAlign     = 'center';
                    element.style.borderRadius  = '50%';
                }
                
                // ドットボタンのスタイルとクリック処理
                const carousel_dotBtns = document.querySelectorAll('.carousel_dotBtn');
                carousel_dotBtns.forEach((item, index)=>{
                    if(index === 0){
                        currentDotbtnStyle();
                    }
                    item.addEventListener('click', () =>{
                        dotbtn_click(index);
                    });
                });

                // ドットボタンスタイル指定
                function currentDotbtnStyle(){
                    carousel_dotBtns.forEach((item, index)=>{
                        if(index === current_index - 1){
                            item.style.backgroundColor = 'red';
                        }else{
                            item.style.backgroundColor = '#ccc';
                        }
                    })
                }

                // ドットボタンをクリックでイベント発火
                function dotbtn_click(click_index){
                    const move = carousel_item_start - carousel_item_width * click_index;
                    carousel_items_container_ul.style.left = `${move}px`;
                    current_index = click_index + 1;
                    currentDotbtnStyle();
                }
            }
        }
    }
});
