{
    'use strict';
    // 必須項目入力管理フラグ
    let submit_flg = [];
    for(let i = 0; i < 8; ++i){
        i < 6 ? submit_flg.push(true): submit_flg.push(false);
    }
    const max_len = 191;
    let count = 0;
    
    window.addEventListener('load', () => {
        requireText('input_name', 'form_name_error', 'conf_name', max_len, submit_flg, count, 'form_conf_btn', 'submit_btn');
        requireFullWidth('input_address', 'form_address_error', 'conf_address', max_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        requireTell('input_tel', 'form_tel_error', 'conf_tel', submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        requireEmail('input_email', 'form_email_error', 'conf_email', max_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        requirePassword('input_password', 'form_password_error', submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        requirePassword('password_confirmation', 'form_password_conf_error', submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableText('input_profile', 'form_profile_error', 'conf_profile', 140, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableImage('text_image', 'image', 'view_image', 'edit_image_btn','del_image_btn', 'image_error', 'image_conf', submit_flg, ++count, 'form_conf_btn', 'submit_btn');
    
        sectionChange('register_input', 'register_conf', 'form_conf_btn');
        returnClick('register_input' ,'register_conf', 'form_return_btn');
    });
}