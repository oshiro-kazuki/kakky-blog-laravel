'use strict';

// 送信ボタン制御管理フラグ
const submit_flg = [
    true, //タイトル
    true, //本文
];

// ニュース入力フォーム
//　タイトルnullチェック
const news_input_title = get_tag_byId('news_input_title');
const news_input_title_confirm_text = get_tag_byId('news_input_title_confirm_text');
news_input_title.addEventListener('input', (e) => {
    const news_input_title_error = get_tag_byId('news_input_title_error');
    null_max_check(e, news_input_title_error, 20, 0);
    get_text(news_input_title_confirm_text, e);
});

// 本文nullチェック
const news_input_content = get_tag_byId('news_input_content');
const news_input_content_confirm_text = get_tag_byId('news_input_content_confirm_text');
news_input_content.addEventListener('input', (e) => {
    const news_input_content_error = get_tag_byId('news_input_content_error');
    null_max_check(e, news_input_content_error, 140, 1);
    get_text(news_input_content_confirm_text, e);
});

// 確認するボタン制御
const news_input_confirm_btn = get_tag_byId('news_input_confirm_btn');
const news_input_confirm_check = (index ,flg) => {
    submit_flg[index] = flg;
    // 制御項目が全て入力されているか判定
    const submit_flg_result = submit_flg.some(element => element === true);
    if(submit_flg_result) {
        cla_add(news_input_confirm_btn, 'hidden');
    } else {
        cla_remove(news_input_confirm_btn, 'hidden');
    }
}

// 確認フォームにテキスト設定
const get_text = (element, event) => {
    element.textContent = event.target.value;
}

// 送信するボタン制御
const news_input_submit_check = (index ,flg) => {
    const news_input_submit_btn = get_tag_byId('news_input_submit_btn');
    submit_flg[index] = flg;
    // 制御項目が全て入力されているか判定
    const submit_flg_result = submit_flg.some(element => element === true);
    news_input_submit_btn.disabled = submit_flg_result;
}

// 入力フォームと確認画面表示切り替え
const news_input_form_input = get_tag_byId('news_input_form_input');
const news_input_form_confirm = get_tag_byId('news_input_form_confirm');
let news_input_screen_flg = true;

news_input_confirm_btn.addEventListener('click', () => {
    if(news_input_screen_flg) {
        news_input_screen_flg = false;
        cla_add(news_input_form_input, 'hidden');
        cla_remove(news_input_form_confirm, 'hidden');
    } else {
        news_input_screen_flg = true;
        cla_remove(news_input_form_input, 'hidden');
        cla_add(news_input_form_confirm, 'hidden');
    }
    location.href = '#';
});

// 戻るボタン
const news_input_return_btn = get_tag_byId('news_input_return_btn');
news_input_return_btn.addEventListener('click', () => {
    news_input_screen_flg = true;
    cla_remove(news_input_form_input, 'hidden');
    cla_add(news_input_form_confirm, 'hidden');
    location.href = '#';
});

