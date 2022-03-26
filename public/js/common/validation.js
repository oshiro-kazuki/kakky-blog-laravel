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

// 全角チェック
const fullWidthCheck = (e, element) => {
    const text = e.target.value;
    const reg = /^[^ \x01-\x7E\uFF61-\uFF9F]+$/;
    if(!reg.test(text)){
        fullWidthFormatText(element);
        return true;
    }
    errorNoneText(element);
    return false;
}

// 電話番号チェック
const tellCheck = (e, element) => {
    const text = e.target.value;
    const reg = /^0[0-9]{10}$/;
    if(!reg.test(text)){
        tellFormatText(element);
        return true;
    }
    errorNoneText(element);
    return false;
}

// 選択有無チェック
const selectCheck = (value, element) => {
    if(value === 0){
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

// パスワード形式チェック
const passwordCheck = (e, element) => {
    const text = e.target.value;
    const reg = /^(?=.*[A-Z])(?=.*[.?_])[0-9a-zA-Z.?_]{8,20}$/;
    if(!reg.test(text)){
        passwordText(element);
        return true;
    }
    errorNoneText(element);
    return false;
}

// 拡張子チェック
const extensionCheck = (e, element) => {
    const isExtension = getExtension(e.target.files[0].name);
    const extensions = new Array('jpg', 'jpeg', 'png');
    const extension_type = isExtension.toLowerCase();
    if(extensions.indexOf(extension_type) === - 1){
        extensionText(element);
        return true;
    }
    errorNoneText(element);
    return false;
}

// 拡張子を取得
const getExtension = (filename) => {
    const pos = filename.lastIndexOf('.');
    if (pos === -1){
        return '';
    }
    return filename.slice(pos + 1);
}

// ファイルサイズチェック
const fileSizeCheck = (e, element) => {
    const max = 3000000; // 3MBを指定
    if(e.target.files[0].size > max){
        fileSizeText(element);
        return true;
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

// 全角でない場合メッセージ表示
const fullWidthFormatText = (element) => {
    element.textContent = '全角で入力してください。';
}

// 電話番号の形式が異なる場合メッセージ表示
const tellFormatText = (element) => {
    element.textContent = '電話番号を入力してください。';
}

// 選択なしの場合メッセージ表示
const selectNoneText = (element) => {
    element.textContent = '選択してください。';
}

// 最大文字数超過の場合メッセージ表示
const maxLengthOverText = (element) => {
    element.textContent = '文字数が上限値を超えています。';
}

// 最大文字数超過の場合メッセージ表示
const extensionText = (element) => {
    element.textContent = '拡張子がjpeg,jpg,pngではありません。';
}

// 最大文字数超過の場合メッセージ表示
const fileSizeText = (element) => {
    element.textContent = '3MBを超えるファイルです。';
}

// パスワード形式が異なる場合メッセージ表示
const passwordText = (element) => {
    element.textContent = '入力内容に誤りがあります。';
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

// nullと最大文字数超過、全角チェック
const nullMaxFullWidthCheck = (e, element, len) => {
    let check_flg = [true,true,true];
    check_flg[0] = nullCheck(e, element);
    if(!check_flg[0]){
        check_flg[1] = fullWidthCheck(e, element);
        if(!check_flg[1]){
            check_flg[2] = maxLengthCheck(e, len, element);
        }
    }
    return check_flg.some(element => element === true);
}

// nullと最大文字数超過、電話番号形式チェック
const nullMaxTellCheck = (e, element) => {
    let check_flg = [true,true,true];
    check_flg[0] = nullCheck(e, element);
    if(!check_flg[0]){
        check_flg[1] = tellCheck(e, element);
        if(!check_flg[1]){
            check_flg[2] = maxLengthCheck(e, 11, element);
        }
    }
    return check_flg.some(element => element === true);
}

// nullとパスワード形式チェック
const nullPasswordCheck = (e, element) => {
    let check_flg = [true,true];
    check_flg[0] = nullCheck(e, element);
    if(!check_flg[0]){
        check_flg[1] = passwordCheck(e, element);
    }
    return check_flg.some(element => element === true);
}

// 画像の拡張子、ファイルサイズチェック
const extensionFileSizeCheck = (e, element) => {
    let check_flg = [true,true];
    check_flg[0] = extensionCheck(e, element);
    if(!check_flg[0]){
        check_flg[1] = fileSizeCheck(e, element);
    }
    return check_flg.some(element => element === true);
}