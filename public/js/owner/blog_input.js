{
    'use strict';
    // 必須項目入力管理フラグ
    // const submit_flg = [true,true,true,true,false,false,false,false,false,false,false];
    let submit_flg = [];
    for(let i = 0; i < 11; ++i){
        i < 4 ? submit_flg.push(true) : submit_flg.push(false);
    }
    const title_len = 20;
    const text_len = 1000;
    let count = 0;
    
    window.addEventListener('load', () => {
        requireText('title', 'title_err', 'title_conf', title_len, submit_flg, count, 'form_conf_btn', 'submit_btn');
        requireSelect('category','category_error', 'category_conf', 'category_init', submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        requireText('origin_title', 'origin_title_err', 'origin_title_conf', title_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        requireText('origin_text', 'origin_text_err', 'origin_text_conf', text_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableImage('text_image', 'image', 'view_image', 'edit_image_btn','del_image_btn', 'image_error', 'image_conf', submit_flg, ++count, 'form_conf_btn', 'submit_btn');

        nullableText('accepted_title', 'accepted_title_err', 'accepted_title_conf', title_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableText('accepted_text', 'accepted_text_err', 'accepted_text_conf', text_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableText('but_title', 'but_title_err', 'but_title_conf', title_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableText('but_text', 'but_text_err', 'but_text_conf', text_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableText('conclusion_title', 'conclusion_title_err', 'conclusion_title_conf', title_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        nullableText('conclusion_text', 'conclusion_text_err', 'conclusion_text_conf', text_len, submit_flg, ++count, 'form_conf_btn', 'submit_btn');
        
        sectionChange('input_section', 'conf_section', 'form_conf_btn');
        returnClick('input_section' ,'conf_section', 'form_return_btn');
    });
}