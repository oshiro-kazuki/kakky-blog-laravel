'use strict';
// タイトル20文字・テキスト70文字　後に...

const news_items = document.querySelectorAll('.news_item');
const news_next_btn = get_tag_byId('news_next_btn');
const news_dot_btns = get_tag_byId('news_dot_btns');
const news_prev_btn = get_tag_byId('news_prev_btn');
const start_news = 50;
const news_width = 250;
const item_view = 1;
const item_x = [];

// パネル初期表示
if(news_items.length > 0){
    news_items.forEach((item, index) => {
        if(index < news_items.length - 2){
            item_x.push(start_news + news_width * index);
        } else {
            item_x.push((start_news - news_width) - (news_width * ((news_items.length - 1) - index)));
        }
        item.style.left = `${item_x[index]}px`;
        create_tag('span', news_dot_btns, false, 'news_dot_btn');
    });
}

// 表示領域で表示
const news_dot_btn = document.querySelectorAll('.news_dot_btn');
const news_dot_btnArray = Array.prototype.slice.call(news_dot_btn);

const dot_btn_options = {
    root: null,
    rootMargin: '0px',
    threshold: 0
}

function dot_btn_callback(item, object){
    item.forEach((entry, index) => {
        if(index === 0)currnt_btn(index);
        object.unobserve(entry.target);
    });
}

const dot_btn_observer = new IntersectionObserver(dot_btn_callback, dot_btn_options);

news_items.forEach(item => {
    dot_btn_observer.observe(item)
});

//　右にスライド処理
function news_next_move(item, index){
    cla_add(item, 'move');
    if(item_x[index] > start_news - news_width * 2){
        item_x[index] = item_x[index] - news_width;
        item.style.opacity = 1;
        if(item_x[index] === start_news)currnt_btn(index);
    }else{
        item_x[index] = start_news + news_width * 2;
        item.style.opacity = 0;
    }
    item.style.left = `${item_x[index]}px`;
}

// 左にスライド処理
function news_prev_move(item, index){
    cla_add(item, 'move');
    if(item_x[index] < news_width * 2 + start_news){
        item_x[index] = item_x[index] + news_width;
        item.style.opacity = 1;
        if(item_x[index] === start_news)currnt_btn(index);
    } else {
        item_x[index] = start_news - (news_width * 2);
        item.style.opacity = 0;
    }
    item.style.left = `${item_x[index]}px`;
}

// ドットボタン押下スライド処理
function news_dot_click_move(click_index){
    news_items.forEach((item, index) => {
        cla_remove(item, 'move');
        const click_index_diff = index - click_index;
        const news_items_half = news_items.length / 2;
        item.style.opacity = 1;
        if(index === click_index) {
            item_x[index] = start_news;
            currnt_btn(index);
        }else{
            if(click_index_diff > news_items_half){
                item_x[index] = start_news + (news_width * (click_index_diff - news_items.length));
            }
            else if(click_index_diff < news_items_half * -1){
                item_x[index] = start_news + (news_width * (click_index_diff + news_items.length));
            }else{
                item_x[index] = start_news + news_width * click_index_diff;
            }
            if(item_x[index] >= start_news + news_width * 2 || item_x[index] <= start_news - news_width * 2){
                item.style.opacity = 0;
            }
        }
        item.style.left = `${item_x[index]}px`;
    });
}

// ドットボタンのカレントスタイル切り替え
function currnt_btn(current_index){
    news_dot_btn.forEach((item, index) => {
        if(current_index === index){
            cla_add(item, 'current');
        }else{
            cla_remove(item, 'current');
        }
    });
}

// 次へボタン押下
news_next_btn.addEventListener('click', () => {
    news_items.forEach((item, index) => {
        news_next_move(item, index);
    });
});

// 前へボタン押下
news_prev_btn.addEventListener('click', () => {
    news_items.forEach((item, index) => {
        news_prev_move(item, index);
    });
});

// ドットボタン押下
news_dot_btn.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        news_dot_click_move(index);
    });
});