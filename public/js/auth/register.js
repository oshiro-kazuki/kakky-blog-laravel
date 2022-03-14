'use strict';
// 必須項目入力管理フラグ
const reg_submit_flg = [true,true,true,true,true,true,false,false];
const max_len = 191;

window.addEventListener('load', () => {
    requireText('input_name', 'form_name_error', 'conf_name', max_len, reg_submit_flg, 0, 'form_conf_btn', 'submit_btn');
    requireFullWidth('input_address', 'form_address_error', 'conf_address', max_len, reg_submit_flg, 1, 'form_conf_btn', 'submit_btn');
    requireTell('input_tel', 'form_tel_error', 'conf_tel', reg_submit_flg, 2, 'form_conf_btn', 'submit_btn');
    requireEmail('input_email', 'form_email_error', 'conf_email', max_len, reg_submit_flg, 3, 'form_conf_btn', 'submit_btn');
    requirePassword('input_password', 'form_password_error', reg_submit_flg, 4, 'form_conf_btn', 'submit_btn');
    requirePassword('password_confirmation', 'form_password_conf_error', reg_submit_flg, 5, 'form_conf_btn', 'submit_btn');
    nullableText('input_profile', 'form_profile_error', 'conf_profile', 140, reg_submit_flg, 6, 'form_conf_btn', 'submit_btn');
    nullableImage('input_profile_image', 'form_profile_image_error', 'conf_image', 'form_del_image_btn', reg_submit_flg, 7, 'form_conf_btn', 'submit_btn');
    
    sectionChange('register_input', 'register_conf', 'form_conf_btn');
    returnClick('register_input' ,'register_conf', 'form_return_btn');
});