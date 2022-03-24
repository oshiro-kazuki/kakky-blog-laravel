{
    'use strict';
    // 必須項目入力管理フラグ
    const submit_flg = [true,true,true,true];
    const max_len = 191;
    const text_len = 140;
    
    window.addEventListener('load', () => {
        requireText('input_name', 'form_name_error', 'conf_name', text_len, submit_flg, 0, 'form_conf_btn', 'submit_btn');
        requireEmail('input_email', 'form_email_error', 'conf_email', max_len, submit_flg, 1, 'form_conf_btn', 'submit_btn');
        requireSelect('input_subject','form_subject_error', 'conf_subject', 'input_subject_init', submit_flg, 2, 'form_conf_btn', 'submit_btn');
        requireText('input_content', 'form_content_error', 'conf_content', text_len, submit_flg, 3, 'form_conf_btn', 'submit_btn');
        
        sectionChange('contact_input', 'contact_conf', 'form_conf_btn');
        returnClick('contact_input' ,'contact_conf', 'form_return_btn');
    });
}