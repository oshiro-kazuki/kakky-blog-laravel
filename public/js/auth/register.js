'use strict';
// 必須項目入力管理フラグ
const submit_flg = [true,true,true,true,true,true,false,false];
const max_len = 191;

window.addEventListener('load', () => {
    requireText('input_name', 'form_name_error', 'conf_name', max_len, submit_flg, 0, 'register_input_conf_btn', 'submit_btn');
    requireFullWidth('input_address', 'form_address_error', 'conf_address', max_len, submit_flg, 1, 'register_input_conf_btn', 'submit_btn');
    requireTell('input_tel', 'form_tel_error', 'conf_tel', submit_flg, 2, 'register_input_conf_btn', 'submit_btn');
    requireEmail('input_email', 'form_email_error', 'conf_email', max_len, submit_flg, 3, 'register_input_conf_btn', 'submit_btn');
    requirePassword('input_password', 'form_password_error', submit_flg, 4, 'register_input_conf_btn', 'submit_btn');
    requirePassword('password_confirmation', 'form_password_conf_error', submit_flg, 5, 'register_input_conf_btn', 'submit_btn');
    nullableText('input_profile', 'form_profile_error', 'conf_profile', 140, submit_flg, 6, 'register_input_conf_btn', 'submit_btn');
    nullableImage('input_profile_image', 'form_profile_image_error', 'conf_image', submit_flg, 7, 'register_input_conf_btn', 'submit_btn');
    
    sectionChange('register_input', 'register_conf', 'register_input_conf_btn');
    returnClick('register_input' ,'register_conf', 'form_return_btn');
});