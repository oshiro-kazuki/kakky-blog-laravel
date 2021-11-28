'use strict';

// 件名リスト
const subject_lists = [
    '- 選択してください -',
    'ご相談',
    'その他',
];

// 送信ボタン制御管理フラグ
const submit_flg = [
    true, //お名前
    true, //メールアドレス
    true, //件名
    true, //お問い合わせ内容
];

// お問い合わせ入力フォーム
//　お名前nullチェック
const contact_mail_name = get_tag_byId('contact_mail_name');
const contact_mail_name_confirm_text = get_tag_byId('contact_mail_name_confirm_text');
contact_mail_name.addEventListener('input', (e) => {
    const contact_mail_name_error = get_tag_byId('contact_mail_name_error');
    const check_result = null_check(e);
    null_check_text(check_result, contact_mail_name_error);
    contact_mail_confirm_check(0, check_result);
    contact_mail_submit_check(0, check_result);
    get_text(contact_mail_name_confirm_text, e);
});

//　メールアドレスnullチェック
const contact_mail_email = get_tag_byId('contact_mail_email');
const contact_mail_email_confirm_text = get_tag_byId('contact_mail_email_confirm_text');
contact_mail_email.addEventListener('input', (e) => {
    const contact_mail_email_error = get_tag_byId('contact_mail_email_error');
    const flgs = [true, true];
    flgs[0] = null_check(e);
    null_check_text(flgs[0], contact_mail_email_error);
    // メールアドレス形式チェック
    if(!flgs[0]) {
        flgs[1] = email_check(e);
        email_check_text(flgs[1], contact_mail_email_error);
    }
    const flg_result = flgs.some(element => element === true);
    contact_mail_confirm_check(1, flg_result);
    contact_mail_submit_check(1, flg_result);
    get_text(contact_mail_email_confirm_text, e);
});


const contact_mail_subject = get_tag_byId('contact_mail_subject');
const contact_mail_subject_confirm_text = get_tag_byId('contact_mail_subject_confirm_text');

// optionタグ生成
subject_lists.forEach((list, index) => {
    create_tag('option', contact_mail_subject, list, false, false, 'value', index);
});

// optionタグ選択文字表示・件名選択チェック
contact_mail_subject.addEventListener('change', (e) => {
    const contact_mail_subject_init = get_tag_byId('contact_mail_subject_init');
    const contact_mail_subject_error = get_tag_byId('contact_mail_subject_error');
    const index = e.target.value;
    contact_mail_subject_init.textContent = subject_lists[index];
    const check_result = select_check(index);
    select_check_text(check_result, contact_mail_subject_error);
    contact_mail_confirm_check(2, check_result);
    contact_mail_submit_check(2, check_result);
    get_select(contact_mail_subject_confirm_text, e);
});

// お問い合わせ内容nullチェック
const contact_mail_content = get_tag_byId('contact_mail_content');
const contact_mail_content_confirm_text = get_tag_byId('contact_mail_content_confirm_text');
contact_mail_content.addEventListener('input', (e) => {
    const contact_mail_content_error = get_tag_byId('contact_mail_content_error');
    const check_result = null_check(e);
    null_check_text(check_result, contact_mail_content_error);
    contact_mail_confirm_check(3, check_result);
    contact_mail_submit_check(3, check_result);
    get_text(contact_mail_content_confirm_text, e);
});

// 確認するボタン制御
const contact_mail_input_submit_btn = get_tag_byId('contact_mail_input_submit_btn');
const contact_mail_confirm_check = (index ,flg) => {
    submit_flg[index] = flg;
    // 制御項目が全て入力されているか判定
    const submit_flg_result = submit_flg.some(element => element === true);
    if(submit_flg_result) {
        cla_add(contact_mail_input_submit_btn, 'hidden');
    } else {
        cla_remove(contact_mail_input_submit_btn, 'hidden');
    }
}

// お問い合わせ確認フォームにテキスト設定
const get_text = (element, event) => {
    element.textContent = event.target.value;
}

// お問い合わせ確認フォームに件名で選択したテキスト設定
const get_select = (element, event) => {
    element.textContent = subject_lists[event.target.value];
}

// 送信するボタン制御
const contact_mail_submit_check = (index ,flg) => {
    const contact_mail_submit_btn = get_tag_byId('contact_mail_submit_btn');
    submit_flg[index] = flg;
    // 制御項目が全て入力されているか判定
    const submit_flg_result = submit_flg.some(element => element === true);
    contact_mail_submit_btn.disabled = submit_flg_result;
}

// 入力フォームと確認画面表示切り替え
const contact_mail_form_input = get_tag_byId('contact_mail_form_input');
const contact_mail_form_confirm = get_tag_byId('contact_mail_form_confirm');
let contact_mail_screen_flg = true;

contact_mail_input_submit_btn.addEventListener('click', () => {
    if(contact_mail_screen_flg) {
        contact_mail_screen_flg = false;
        cla_add(contact_mail_form_input, 'hidden');
        cla_remove(contact_mail_form_confirm, 'hidden');
    } else {
        contact_mail_screen_flg = true;
        cla_remove(contact_mail_form_input, 'hidden');
        cla_add(contact_mail_form_confirm, 'hidden');
    }
    location.href = '#';
});

// 戻るボタン
const contact_mail_return_btn = get_tag_byId('contact_mail_return_btn');
contact_mail_return_btn.addEventListener('click', () => {
    contact_mail_screen_flg = true;
    cla_remove(contact_mail_form_input, 'hidden');
    cla_add(contact_mail_form_confirm, 'hidden');
    location.href = '#';
});