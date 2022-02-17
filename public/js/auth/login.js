'use strict';
// 項目入力管理フラグ
const log_submit_flg = [true,true];

loginText('login_email', 'login_email_error', log_submit_flg, 0, 'login_submit');
loginText('login_password', 'login_password_error', log_submit_flg, 1, 'login_submit');