'use strict';
const footer_list = get_tag_byId('footer_list');
const footer_sns = get_tag_byId('footer_sns');

// スライドで表示
const target = document.querySelectorAll('.footer_list_li');
const targetArray = Array.prototype.slice.call(target);

let options = {
    root: null,
    rootMargin: '0px 0px 0px 0px',
    threshold: 0
}

const callback = (entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.classList.remove('hidden');
        }
    });
}

let observer = new IntersectionObserver(callback, options);

targetArray.forEach(tgt => {
    observer.observe(tgt)
});