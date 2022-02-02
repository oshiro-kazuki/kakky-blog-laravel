'use strict';
// ログインボタン制御管理フラグ
const login_submit_flg = [true,true];

const login_email_input = get_tag_byId('login_email_input');
if(login_email_input){
    login_email_input.addEventListener('input', (e) => {
        const login_email_error = get_tag_byId('login_email_error');
        const result = nullMaxEmailCheck(e, login_email_error, 191);
        login_submit_flg_check(0, result);
    });
}

const login_password_input = get_tag_byId('login_password_input');
if(login_password_input){
    login_password_input.addEventListener('input', (e) => {
        const login_password_error = get_tag_byId('login_password_error');
        const result = nullMaxCheck(e, login_password_error, 20);
        login_submit_flg_check(1, result);
    });
}

// ログインボタン制御
const login_submit_btn = get_tag_byId('login_submit_btn');
const login_submit_flg_check = (index ,flg) => {
    login_submit_flg[index] = flg;
    // 制御項目が全て入力されているか判定
    const submit_flg_result = login_submit_flg.some(element => element === true);
    if(submit_flg_result) {
        login_submit_btn.disabled = true;
    } else {
        login_submit_btn.disabled = false;
    }
}