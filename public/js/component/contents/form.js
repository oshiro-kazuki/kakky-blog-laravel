'use strict';
// 必須項目のテキスト
const requireText = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele);
    const gfa = setFlgArray(gea.in.value, gea.er.textContent);
    if(!gfa.val_flg && gfa.text_flg){
        returnCheck(target_flg, index, conf_btn, submit_btn, gea.co, gea.in.value);
    }else{
        gea.in.addEventListener('input', (e) => {
            const result = nullMaxCheck(e, gea.er, max);
            confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
            getText(gea.co, e.target.value);
        });
    }
}

// 必須項目の全角
const requireFullWidth = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele);
    const gfa = setFlgArray(gea.in.value, gea.er.textContent);
    if(!gfa.val_flg && gfa.text_flg){
        returnCheck(target_flg, index, conf_btn, submit_btn, gea.co, gea.in.value);
    }else{
        gea.in.addEventListener('input', (e) => {
            const result = nullMaxFullWidthCheck(e, gea.er, max);
            confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
            getText(gea.co, e.target.value);
        });
    }
}

// 必須項目の電話番号
const requireTell = (input_ele, err_ele, conf_ele, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele);
    const gfa = setFlgArray(gea.in.value, gea.er.textContent);
    if(!gfa.val_flg && gfa.text_flg){
        returnCheck(target_flg, index, conf_btn, submit_btn, gea.co, gea.in.value);
    }else{
        gea.in.addEventListener('input', (e) => {
            const result = nullMaxTellCheck(e, gea.er);
            confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
            getText(gea.co, e.target.value);
        });
    }
}

// 必須項目のEmail
const requireEmail = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele);
    const gfa = setFlgArray(gea.in.value, gea.er.textContent);
    if(!gfa.val_flg && gfa.text_flg){
        returnCheck(target_flg, index, conf_btn, submit_btn, gea.co, gea.in.value);
    }else{
        gea.in.addEventListener('input', (e) => {
            const result = nullMaxEmailCheck(e, gea.er, max);
            confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
            getText(gea.co, e.target.value);
        });
    }
}

// 必須項目のselect
const requireSubject = (input_ele, err_ele, conf_ele, init_ele, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele);
    const init = get_tag_byId(init_ele);
    const gfa = setFlgArray(gea.in.value, gea.er.textContent);
    if(!gfa.val_flg && gfa.text_flg){
        returnCheck(target_flg, index, conf_btn, submit_btn, gea.co, gea.in.value);
    }else{
        gea.in.addEventListener('change', (e) => {
            const intValue = Number(e.target.value);
            getText(init, e.target[intValue].textContent);
            init.style.color = 'black';
            const result = selectCheck(intValue, gea.er);
            confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
            for(let i = 0;i < gea.in.options.length; i++){
                if(intValue === i){
                    gea.in.options[i].setAttribute('selected', 'selected')
                }else{
                    gea.in.options[i].removeAttribute('selected')
                }
            }
            getText(gea.co, e.target[intValue].textContent);
        });
    }
}

// 必須項目のパスワード
const requirePassword = (input_ele, err_ele, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, false);
    gea.in.addEventListener('input', (e) => {
        const result = nullPasswordCheck(e, gea.er);
        confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
    });
}

// 必須項目でないテキスト
const nullableText = (input_ele, err_ele, conf_ele, max, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele);
    const gfa = setFlgArray(gea.in.value, gea.er.textContent);
    if(!gfa.val_flg && gfa.text_flg){
        returnCheck(target_flg, index, conf_btn, submit_btn, gea.co, gea.in.value);
    }else{
        gea.in.addEventListener('input', (e) => {
            if(e.target.textLength > 0){
                const result = maxLengthCheck(e, max, gea.er);
                confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
                getText(gea.co, e.target.value);
            }else{
                gea.co.textContent = '-';
            }
        });
    }
}

// 必須項目でない画像
const nullableImage = (input_ele, err_ele, conf_ele, del_ele, target_flg, index, conf_btn, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele, conf_ele, del_ele);
    gea.in.addEventListener('change', (e) => {
        const tag_text = get_tag_query(`#${conf_ele} p`);
        const get_image = get_tag_query(`#${conf_ele} img`);
        if(get_image === null){
            create_img_tag(gea.co);
            tag_text.remove();
            cla_remove(gea.de, 'hidden');
        }
        const result = extensionFileSizeCheck(e, gea.er);
        confSubmitCheck(target_flg, index, result, conf_btn, submit_btn);
        setImage(conf_ele, e.target.files[0]);
        delImgClick(gea.de, gea.co, gea.in, conf_ele);
    });
}

// ログインフォームテキスト
const loginText = (input_ele, err_ele, target_flg, index, submit_btn) => {
    const gea = setElementArray(input_ele, err_ele);
    gea.in.addEventListener('input', (e) => {
        const result = nullCheck(e, gea.er);
        submitCheck(target_flg, index, result, submit_btn);
    });
}

// 入力、エラー、確認の要素取得
const setElementArray = (input_ele, err_ele, conf_ele = false, del_ele = false) => {
    const input_tag = get_tag_byId(input_ele);
    const err_tag = get_tag_byId(err_ele);
    if(conf_ele && !del_ele){
        const conf_tag = get_tag_byId(conf_ele);
        return {in : input_tag,er : err_tag,co : conf_tag};
    }else if(del_ele && !conf_ele){
        const del_tag = get_tag_byId(del_ele);
        return {in : input_tag,er : err_tag,de : del_tag};
    }else if(conf_ele && del_ele){
        const conf_tag = get_tag_byId(conf_ele);
        const del_tag = get_tag_byId(del_ele);
        return {in : input_tag,er : err_tag,co : conf_tag,de : del_tag};
    }
    return {in:input_tag,er:err_tag};
}

// 入力、エラーの要素値の有無判定
const setFlgArray = (in_val, err_text) => {
    const val_flg = in_val === '' ? true : false;
    const text_flg = err_text === '' ? true : false;
    return {val_flg:val_flg,text_flg:text_flg};
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
const submitCheck = (target_flg, index, result, btn_ele) => {
    const target_btn = get_tag_byId(btn_ele);
    target_flg[index] = result;
    // 制御項目が全て入力されているか判定
    const flg_result = target_flg.some(element => element === true);
    target_btn.disabled = flg_result;
}

// 確認と送信ボタン制御
const confSubmitCheck = (target_flg, index, result, conf_ele, submit_ele) => {
    confCheck(target_flg, index, result, conf_ele);
    submitCheck(target_flg, index, result, submit_ele);
}

// エラー後確認ボタン制御
const returnCheck = (target_flg, index, conf_btn, submit_btn, conf_ele, text_val) => {
    confCheck(target_flg, index, false, conf_btn);
    submitCheck(target_flg, index, false, submit_btn);
    getText(conf_ele, text_val);
}

// 確認フォームにテキスト設定
const getText = (element, text_val) => {
    element.textContent = text_val;
}

// 確認フォームに画像設定
const setImage = (conf_ele, val) => {
    const target = get_tag_query(`#${conf_ele} img`);
    const file_reader = new FileReader();
    file_reader.onload = function(){
        target.setAttribute('src', file_reader.result);
    }
    file_reader.readAsDataURL(val);
}

// 画像削除ボタンクリックイベント
const delImgClick = (del_btn, tag_conf, tag_input, conf_ele) => {
    del_btn.addEventListener('click', () => {
        const tag_img = get_tag_query(`#${conf_ele} img`);
        if(tag_img === null){
            return;
        }
        if(confirm('削除してもよろしいですか？')){
            tag_img.remove();
            create_tag('p', tag_conf, '-');
            tag_input.value = '';
            cla_add(del_btn, 'hidden');
        }
    });
}

// 入力フォームと確認フォーム切り替え
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

// 戻るボタンクリックイベント
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