'use strict';

// タグ生成
const create_tag = (element, parent, text = false, cla = false, cla1 = false, attribute_name = false, attribute_val = false) => {
    const tag = document.createElement(element);
    if(text) {
        tag.textContent = text;
    }
    if(cla) {
        cla_add(tag, cla);
    }
    if(cla1) {
        cla_add(tag, cla1);
    }
    if(attribute_name) {
        tag.setAttribute(attribute_name, `${attribute_val}`);
    }
    parent.appendChild(tag);
    return tag;
}

// aタグ生成
const create_a_tag = (parent, link = false, cla = false, text = false) => {
    const tag = document.createElement('a');
    if(link) {
        tag.href = link;
    }
    if(cla) {
        cla_add(tag, cla);
    }
    if(text) {
        tag.textContent = text;
    }
    parent.appendChild(tag);
    return tag;
}

// imgタグ生成
const create_img_tag = (parent, link = false, cla = false) => {
    const tag = document.createElement('img');
    if(link) {
        tag.src = link;
    }
    if(cla) {
        cla_add(tag, cla);
    }
    parent.appendChild(tag);
    return tag;
}

// タグをidで取得
const get_tag_byId = (element) => {
const tag = document.getElementById(element);
return tag;
}

// タグをクラスや属性から取得
const get_tag_query = (element) => {
const tag = document.querySelector(element);
return tag;
}

// class追加 第二引数はクラスの追加、第三引数はスタイルを追加
const cla_add = (element, cla = false, css = false, val = false) => {
    const tag = element;
    if(cla) {
        tag.classList.add(cla);
    }
    if(css) {
        tag.style.css = val;
    }
    return tag;
}

// classsa削除 第二引数はクラスの削除、第三引数はスタイルを追加
const cla_remove = (element, cla = false, css = false, val = false) => {
    const tag = element;
    if(cla) {
        tag.classList.remove(cla);
    }
    if(css) {
        tag.style.css = val;
    }
    return tag;
}