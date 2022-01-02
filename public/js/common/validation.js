'use strict';

// nullチェック
const null_check = (e) => {
    const text = e.target.value;
    return text === '' ? true : false;
}

// メールアドレス形式チェック
const email_check = (e) => {
    const text = e.target.value;
    const reg = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/;
    return reg.test(text) ? false : true;
}

// 選択有無チェック
const select_check = (index) => {
    return index === '0' ? true : false;
}

// 最大文字数チェック
const max_length_check = (e, len) => {
    const text = e.target.value;
    return text.length > len ? true : false;
}

// nullの場合メッセージ表示
const null_check_text = (result, element) => {
    element.textContent = result ? '入力してください。' : '';
}

// メールアドレス形式が異なる場合メッセージ表示
const email_check_text = (result, element) => {
    element.textContent = result ? 'メールアドレスの形式が違います。' : '';
}

// 選択なしの場合メッセージ表示
const select_check_text = (result, element) => {
    element.textContent = result ? '件名を選択してください。' : '';
}

// 最大文字数超過の場合メッセージ表示
const max_length_check_text = (result, element) => {
    element.textContent = result ? '文字数が上限値を超えています。' : '';
}

// nullと最大文字数超過チェック
const null_max_check = (event, element, len, index) => {
    const null_check_result = null_check(event);
    null_check_text(null_check_result, element);
    if(!null_check_result){
        const max_length_check_result = max_length_check(event, len);
        max_length_check_text(max_length_check_result, element);
        news_input_confirm_check(index, max_length_check_result);
        news_input_submit_check(index, max_length_check_result);
    }
}