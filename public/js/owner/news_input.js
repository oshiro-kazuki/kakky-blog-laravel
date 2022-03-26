'use strict';
{
    // 送信ボタン制御管理フラグ
    const submit_flg = [true,true];
    const title_len = 20;
    const content_len = 140;
    
    window.addEventListener('load', () => {
        requireText('input_title', 'title_error', 'conf_title', title_len, submit_flg, 0, 'form_conf_btn', 'submit_btn');
        requireText('input_content', 'content_error', 'conf_content', content_len, submit_flg, 1, 'form_conf_btn', 'submit_btn');
        
        sectionChange('input_section', 'conf_section', 'form_conf_btn');
        returnClick('input_section' ,'conf_section', 'form_return_btn');
    });
}