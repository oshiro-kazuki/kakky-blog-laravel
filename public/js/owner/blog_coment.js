{
    'use strict';
    
    let submit_flg = [true]; // 送信ボタン制御フラグ
    const comment = get_tag_byId('comment');
    const hidden_conf_btn = get_tag_byId('hidden_conf_btn');
    const hidden_btn = get_tag_byId('hidden_btn');
    const comentLength = comment.getAttribute('maxlength'); // 文字数上限値取得

    // 文字入力必須処理
    requireText('comment', 'comment_err', 'comment_conf', comentLength, submit_flg, 0, 'form_conf_btn', 'submit_btn');
    // 送信ボタン活性化制御
    sectionChange('input_section', 'conf_section', 'form_conf_btn');
    // 戻るボタン押下イベント
    returnClick('input_section' ,'conf_section', 'form_return_btn');
}