'use strict';
const CONTACT_BTN_CONTENTS = ['お問い合わせはこちら', '/info/contact_mail/'];
// 問い合わせボタン
const contact_btn = get_tag_byId('contact_btn');
create_a_tag(contact_btn, CONTACT_BTN_CONTENTS[1], false, CONTACT_BTN_CONTENTS[0]);