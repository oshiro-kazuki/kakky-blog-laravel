'use strict';

// タグ生成
const create_tag = (element, parent, text = false, cla = false) => {
    const tag = document.createElement(element);
    if(text) {
        tag.textContent = text;
    }
    if(cla) {
        cla_add(tag, cla);
    }
    parent.appendChild(tag);
    return tag;
}

// aタグ生成
const create_a_tag = (element, parent, link = false, cla = false, text = false) => {
    const tag = document.createElement(element);
    if(link) {
        tag.href = link;
    }
    if(cla) {
        cla_add(tag, cla);
    }
    if(text) {
        tag.textContent = Text;
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