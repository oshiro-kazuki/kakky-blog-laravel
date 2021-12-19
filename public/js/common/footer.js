'use strict';

const FOOTER_LIST_CONTENTS = [
    {text: 'プロフィール', link: '/info/profile/'},
    {text: 'お問い合わせ', link: '/info/contact_mail/'},
    {text: 'プライバシーポリシー', link: '/info/privacy_policy'},
];

const FOOTER_SNS_CONTENTS = [
    {logo: '/img/sns/twitter_logo.png', link: 'https://twitter.com/kazzzzk19'},
    {logo: '/img/sns/facebook_logo.png', link: 'https://www.facebook.com/kazzzzk19'},
];

const footer_list = get_tag_byId('footer_list');
const footer_sns = get_tag_byId('footer_sns');

// フッターメニュー
for(let i = 0; i < FOOTER_LIST_CONTENTS.length; i++) {
    const list_li = create_tag('li', footer_list, false, 'footer_list_li', 'hidden');
    create_a_tag(list_li, FOOTER_LIST_CONTENTS[i].link, false, FOOTER_LIST_CONTENTS[i].text);
}

// フッターSNS
for(let i = 0; i < FOOTER_SNS_CONTENTS.length; i++) {
    const list_li = create_tag('li', footer_sns, false);
    const list_a = create_a_tag(list_li, FOOTER_SNS_CONTENTS[i].link, 'aaa');
    create_img_tag(list_a, FOOTER_SNS_CONTENTS[i].logo, 'footer_sns_logo');
}

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