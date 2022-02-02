'use strict';

// nullチェック
const nullCheck = (e, element) => {
    const text = e.target.value;
    if(text === ''){
        nullText(element)
        return true;
    }
    errorNoneText(element);
    return false;
}

// メールアドレス形式チェック
const emailCheck = (e, element) => {
    const text = e.target.value;
    const reg = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/;
    if(!reg.test(text)){
        emailFormatText(element);
        return true;
    }
    errorNoneText(element);
    return false;
}

// 選択有無チェック
const selectCheck = (index, element) => {
    if(index === '0'){
        selectNoneText(element);
        return true;
    }
    errorNoneText(element);
    return false;
}

// 最大文字数チェック
const maxLengthCheck = (e, len, element) => {
    const text = e.target.value;
    if(text.length > len){
        maxLengthOverText(element);
        return true
    }
    errorNoneText(element);
    return false;
}

// nullの場合メッセージ表示
const nullText = (element) => {
    element.textContent = '入力してください。';
}

// メールアドレス形式が異なる場合メッセージ表示
const emailFormatText = (element) => {
    element.textContent = 'メールアドレスの形式が違います。';
}

// 選択なしの場合メッセージ表示
const selectNoneText = (element) => {
    element.textContent = '件名を選択してください。';
}

// 最大文字数超過の場合メッセージ表示
const maxLengthOverText = (element) => {
    element.textContent = '文字数が上限値を超えています。';
}

const errorNoneText = (element) => {
    element.textContent = '';
}

// nullと最大文字数超過チェック
const nullMaxCheck = (e, element, len) => {
    const null_esult = nullCheck(e, element);
    if(!null_esult){
        const max_result = maxLengthCheck(e, len, element);
        return max_result ? true : false;
    }else{
        return true;
    }
}

// nullと最大文字数超過、email形式チェック
const nullMaxEmailCheck = (e, element, len) => {
    let check_flg = [true,true,true];
    check_flg[0] = nullCheck(e, element);
    if(!check_flg[0]){
        check_flg[1] = emailCheck(e, element);
        if(!check_flg[1]){
            check_flg[2] = maxLengthCheck(e, len, element);
        }
    }
    return check_flg.some(element => element === true);
}