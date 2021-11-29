'use strict';

// nullチェック
const null_check = (e) => {
    const text = e.target.value;
    return text == '' ? true : false;
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