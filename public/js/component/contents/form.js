'use strict';
// 必須項目のテキスト
const requireText = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    const conf_tag = get_tag_byId(conf_ele);
    input_tag.addEventListener('input', (e) => {
        const err_tag = get_tag_byId(err_ele);
        const result = nullMaxCheck(e, err_tag, max);
        confCheck(target_flg, index, result, conf_btn);
        submitCheck(target_flg, index, result, submit_btn);
        getText(conf_tag, e);
    });
}

// 必須項目の全角
const requireFullWidth = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    const conf_tag = get_tag_byId(conf_ele);
    input_tag.addEventListener('input', (e) => {
        const err_tag = get_tag_byId(err_ele);
        const result = nullMaxFullWidthCheck(e, err_tag, max);
        confCheck(target_flg, index, result, conf_btn);
        submitCheck(target_flg, index, result, submit_btn);
        getText(conf_tag, e);
    });
}

// 必須項目の電話番号
const requireTell = (input_ele, err_ele, conf_ele, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    const conf_tag = get_tag_byId(conf_ele);
    input_tag.addEventListener('input', (e) => {
        const err_tag = get_tag_byId(err_ele);
        const result = nullMaxTellCheck(e, err_tag);
        confCheck(target_flg, index, result, conf_btn);
        submitCheck(target_flg, index, result, submit_btn);
        getText(conf_tag, e);
    });
}

// 必須項目のEmail
const requireEmail = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    const conf_tag = get_tag_byId(conf_ele);
    input_tag.addEventListener('input', (e) => {
        const err_tag = get_tag_byId(err_ele);
        const result = nullMaxEmailCheck(e, err_tag, max);
        confCheck(target_flg, index, result, conf_btn);
        submitCheck(target_flg, index, result, submit_btn);
        getText(conf_tag, e);
    });
}

// 必須項目のパスワード
const requirePassword = (input_ele, err_ele, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    input_tag.addEventListener('input', (e) => {
        const err_tag = get_tag_byId(err_ele);
        const result = nullPasswordCheck(e, err_tag);
        confCheck(target_flg, index, result, conf_btn);
        submitCheck(target_flg, index, result, submit_btn);
    });
}

// 必須項目でないテキスト
const nullableText = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    const conf_tag = get_tag_byId(conf_ele);
    input_tag.addEventListener('input', (e) => {
        if(e.target.textLength > 0){
            const err_tag = get_tag_byId(err_ele);
            const result = maxLengthCheck(e, max, err_tag);
            confCheck(target_flg, index, result, conf_btn);
            submitCheck(target_flg, index, result, submit_btn);
            getText(conf_tag, e);
        }else{
            conf_tag.textContent = '-';
        }
    });
}

// 必須項目でない画像
const nullableImage = (input_ele, err_ele, conf_ele, target_flg, index, conf_btn, submit_btn) => {
    const input_tag = get_tag_byId(input_ele);
    const conf_tag = get_tag_byId(conf_ele);
    const text = get_tag_query(`#${conf_ele} p`);
    input_tag.addEventListener('change', (e) => {
        text.remove();
        const image = create_img_tag(conf_tag);
        const err_tag = get_tag_byId(err_ele);
        const result = extensionFileSizeCheck(e, err_tag);
        confCheck(target_flg, index, result, conf_btn);
        submitCheck(target_flg, index, result, submit_btn);
        getImage(image, e);
    });
}

// 確認ボタン制御
const confCheck = (target_flg, index, result, btn_ele) => {
    const target_btn = get_tag_byId(btn_ele);
    target_flg[index] = result;
    // 制御項目が全て入力されているか判定
    const flg_result = target_flg.some(element => element === true);
    if(flg_result) {
        cla_add(target_btn, 'hidden');
    } else {
        cla_remove(target_btn, 'hidden');
    }
}

// 送信するボタン制御
const submitCheck = (target_flg, index ,result, btn_ele) => {
    const target_btn = get_tag_byId(btn_ele);
    target_flg[index] = result;
    // 制御項目が全て入力されているか判定
    const flg_result = target_flg.some(element => element === true);
    target_btn.disabled = flg_result;
}

// 確認フォームにテキスト設定
const getText = (element, event) => {
    element.textContent = event.target.value;
}

// 確認フォームに画像設定
const getImage = (element, event) => {
    const file_reader = new FileReader();
	file_reader.onload = function(){
		element.setAttribute('src', file_reader.result);
	}
	file_reader.readAsDataURL(event.target.files[0]);
}

const sectionChange = (input_sec, conf_sec, input_btn) => {
    const input_section = get_tag_byId(input_sec);
    const conf_section = get_tag_byId(conf_sec);
    const btn = get_tag_byId(input_btn);
    btn.addEventListener('click', () => {
        const reg = /hidden/;
        const is = reg.test(input_section.className);
        const cs = reg.test(conf_section.className);
        if(cs){
            cla_add(input_section, 'hidden');
            cla_remove(conf_section, 'hidden');
        }else{
            cla_remove(input_section, 'hidden');
            cla_add(conf_section, 'hidden');
        }
        location.href = '#';
    });
}

const returnClick = (input_sec, conf_sec, element) => {
    const btn = get_tag_byId(element);
    const input_section = get_tag_byId(input_sec);
    const conf_section = get_tag_byId(conf_sec);
    btn.addEventListener('click', () => {
        cla_remove(input_section, 'hidden');
        cla_add(conf_section, 'hidden');
        location.href = '#';
    });
}