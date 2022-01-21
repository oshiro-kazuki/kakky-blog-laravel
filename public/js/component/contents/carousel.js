'use strict';
window.addEventListener('load', () =>{
    const carousel_items_container = get_tag_query('.carousel_items_container');

    const start_carousel = 50;
    const carousel_dot_btns_width = 150;
    const carousel_item_padding = 10;
    const carousel_itema = document.querySelector('.carousel_item');
    const carousel_width = carousel_itema.offsetWidth + carousel_item_padding;
    const item_x = [];
    
    if(carousel_items_container){
        carousel_items_container.style.display = 'flex';
        carousel_items_container.style.position = 'relative';

        const carousel_item = document.querySelectorAll('.carousel_item');
        const carousel_btns_container = get_tag_query('.carousel_btns_container');
    
        if(carousel_btns_container){
            const carousel_prev_btn = create_tag('div', carousel_btns_container, false, 'carousel_prev_btn');
            if(carousel_prev_btn){
                cla_add(carousel_prev_btn, 'material-icons');
                carousel_prev_btn.textContent= 'arrow_back_ios';
                carouselBtnStyle(carousel_prev_btn);
                carousel_prev_btn.style.paddingLeft = '8px';
            }   
          
            const carousel_dot_btns = create_tag('div', carousel_btns_container, false, 'carousel_dot_btns');;
            if(carousel_dot_btns){
                carousel_dot_btns.style.display = 'flex';
                carousel_dot_btns.style.justifyContent = 'space-around';
                carousel_dot_btns.style.alignItems = 'center';
                carousel_dot_btns.style.width = `${carousel_dot_btns_width}px`;
            }
        
            const carousel_next_btn = create_tag('div', carousel_btns_container, false, 'carousel_next_btn');
            if(carousel_next_btn){
                cla_add(carousel_next_btn, 'material-icons');
                carousel_next_btn.textContent= 'arrow_forward_ios';
                carouselBtnStyle(carousel_next_btn);
            }
        
            function carouselBtnStyle(element){
                element.style.display = 'block';
                element.style.width = '50px';
                element.style.height = '50px';
                element.style.lineHeight = '45px';
                element.style.textAlign = 'center';
                element.style.borderRadius = '50%';
            }
    
            // 表示領域で表示
            const dot_btn_options = {
                root: null,
                rootMargin: '0px',
                threshold: 0
            }
            
            function dot_btn_callback(item, object){
                if(item.length > 0){
                    item.forEach((entry, index) => {
                        if(index === 0)currnt_btn(index);
                        object.unobserve(entry.target);
                    });
                }
            }
        
            const dot_btn_observer = new IntersectionObserver(dot_btn_callback, dot_btn_options);
            
            if(carousel_item.length > 0){
                carousel_item.forEach(item => {
                    dot_btn_observer.observe(item)
                });
            }
    
            // 次へボタン押下
            carousel_next_btn.addEventListener('click', () => {
                if(carousel_item.length > 0){
                    carousel_item.forEach((item, index) => {
                        carousel_next_move(item, index);
                    });
                }
            });
            
            // 前へボタン押下
            carousel_prev_btn.addEventListener('click', () => {
                if(carousel_item.length > 0){
                    carousel_item.forEach((item, index) => {
                        carousel_prev_move(item, index);
                    });
                }
            });

            // パネル初期表示
            if(carousel_item.length > 0){
                carousel_item.forEach((item, index) => {
                    item.style.position = 'absolute';
    
                    if(index < carousel_item.length - 2){
                        item_x.push(start_carousel + carousel_width * index);
                    } else {
                        item_x.push((start_carousel - carousel_width) - (carousel_width * ((carousel_item.length - 1) - index)));
                    }
                    item.style.left = `${item_x[index]}px`;
                    if(carousel_btns_container && carousel_dot_btns !== ''){
                        create_dot_btn(carousel_dot_btns);
                    }
                });
            }
        }
    
        const carousel_dot_btn = document.querySelectorAll('.carousel_dot_btn');
    
        // ドットボタン押下
        if(carousel_dot_btn.length > 0){
            carousel_dot_btn.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    carousel_dot_click_move(index);
                });
            });
        }
    
        // カルーセルのドットボタン生成
        function create_dot_btn(parent){
            const dot_btn = create_tag('span', parent, false, 'carousel_dot_btn');
            dot_btn.style.display = 'block';
            dot_btn.style.width = '10px';
            dot_btn.style.height = '10px';
            dot_btn.style.backgroundColor = '#ccc';
            dot_btn.style.borderRadius = '50%';
        }
        
        //　右にスライド処理
        function carousel_next_move(item, index){
            carousel_move_style(item);
            if(item_x[index] > start_carousel - carousel_width * 2){
                item_x[index] = item_x[index] - carousel_width;
                item.style.opacity = 1;
                if(item_x[index] === start_carousel)currnt_btn(index);
            }else{
                item_x[index] = start_carousel + carousel_width * 2;
                item.style.opacity = 0;
            }
            item.style.left = `${item_x[index]}px`;
        }
        
        // 左にスライド処理
        function carousel_prev_move(item, index){
            carousel_move_style(item);
            if(item_x[index] < carousel_width * 2 + start_carousel){
                item_x[index] = item_x[index] + carousel_width;
                item.style.opacity = 1;
                if(item_x[index] === start_carousel)currnt_btn(index);
            } else {
                item_x[index] = start_carousel - (carousel_width * 2);
                item.style.opacity = 0;
            }
            item.style.left = `${item_x[index]}px`;
        }
    
        // カルーセルの移動スタイル
        function carousel_move_style(item){
            item.style.transitionProperty = 'left';
            item.style.transitionDuration = '.5s';
            item.style.transitionTimingRunction = 'ease-out';
        }
        
        // ドットボタンのカレントスタイル切り替え
        function currnt_btn(current_index){
            if(carousel_dot_btn.length > 0){
                carousel_dot_btn.forEach((item, index) => {
                    if(current_index === index){
                        item.style.backgroundColor = 'red';
                    }else{
                        item.style.backgroundColor = '#ccc';
                    }
                });
            }
        }
        
        // ドットボタン押下スライド処理
        function carousel_dot_click_move(click_index){
            if(carousel_item.length > 0){
                carousel_item.forEach((item, index) => {
                    cla_remove(item, 'move');
                    const click_index_diff = index - click_index;
                    const carousel_items_half = carousel_item.length / 2;
                    item.style.opacity = 1;
                    if(index === click_index) {
                        item_x[index] = start_carousel;
                        currnt_btn(index);
                    }else{
                        if(click_index_diff > carousel_items_half){
                            item_x[index] = start_carousel + (carousel_width * (click_index_diff - carousel_item.length));
                        }
                        else if(click_index_diff < carousel_items_half * -1){
                            item_x[index] = start_carousel + (carousel_width * (click_index_diff + carousel_item.length));
                        }else{
                            item_x[index] = start_carousel + carousel_width * click_index_diff;
                        }
                        if(item_x[index] >= start_carousel + carousel_width * 2 || item_x[index] <= start_carousel - carousel_width * 2){
                            item.style.opacity = 0;
                        }
                    }
                    item.style.left = `${item_x[index]}px`;
                });
            }
        }
        
        // スワイプイベント
        let startX  = 0;
        let endX    = 0;
        let endY    = 0;
        let swipe_x = 0;
        let swipe_y = 0;
        const swiper_limit = 50;
        
        function logSwipeStart(event) {
            event.preventDefault();
            startX = event.touches[0].pageX;
        }
        
        function logSwipe(event) {
            event.preventDefault();
            endX = event.touches[0].pageX;
            endY = event.touches[0].pageY;
        }
        
        function logSwipeEnd(event) {
            event.preventDefault();
            swipe_x = endX - startX;
            if(carousel_item.length > 0){
                carousel_item.forEach((item, index) => {            
                    if(swipe_x > swiper_limit && endX !== 0){
                        carousel_prev_move(item, index);
                    }else if(swipe_x < -swiper_limit && endX !== 0){
                        carousel_next_move(item, index);
                    }else if(endX === 0 && endY === 0){
                        const carousel_item_links = document.querySelectorAll('.carousel_item_link');
                        if(carousel_item_links){
                            const current_link = item.style.left;
                            if(current_link === `${start_carousel}px`){
                                location.href = carousel_item_links[index].href;
                            }
                        }
                    }else{
                        return;
                    }
                });
            }
            startX  = 0;
            endX    = 0;
            endY    = 0;
            swipe_x = 0;
        }
        
        carousel_items_container.addEventListener('touchstart', logSwipeStart);
        
        carousel_items_container.addEventListener('touchend', logSwipeEnd);
        
        carousel_items_container.addEventListener('touchmove', logSwipe);
    }
});
