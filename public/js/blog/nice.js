{
    'use strict';
    const item_nice = get_tag_byId('item_nice');
    const nice_btn = get_tag_byId('nice_btn');
    const id_value = get_tag_query('input[name="id"]').value;
    const cookie_limit = 3; // 3ヶ月に設定
    let cookie_value = [];

    const cookie_info = {
        name    : 'blog_nice',
        domain  : document.domain,
        path    : '/',
    }

    const getCookie = ()=>{
        const cookies = document.cookie.split(';');

        cookies.forEach(value =>{
            const key = value.split('=');   // keyごとに配列に整形
            const key_trim = key[0].trim(); // keyの空白を削除
            
            if(key_trim === cookie_info.name){
                cookie_value = decodeURIComponent(key[1]).split(','); // cookieの値を配列に整形
                cookie_value.forEach(value => {
                    if(value === id_value){
                        cla_add(nice_btn, 'done');
                    }
                })
            }
        })
    }

    const cookieText = (cookies, id)=>{
        let text;
        if(cookies.length > 0){
            text = `${cookies.join(',')},${id}`;
        }else{
            text = id;
        }
        return text;
    }

    const cookieTime = ()=>{
        const now = new Date()
        now.setMonth(now.getMonth() + cookie_limit);
        return now.toGMTString();
    }

    const setCookie = ()=>{
        const value = cookieText(cookie_value, id_value);
        let in_cookie;
        in_cookie = `${cookie_info.name}=${encodeURIComponent(value)};`;
        in_cookie += `domain=${cookie_info.domain};`;
        in_cookie += `path=${cookie_info.path};`;
        in_cookie += `expires=${cookieTime()};`;
        document.cookie = in_cookie;
    }
    
    const niceUp = ()=>{
        item_nice.textContent = item_nice.textContent === '-' ? 1 : Number(item_nice.textContent) + 1;;
    }

    nice_btn.addEventListener('click', ()=>{
        // doneがあれば発火しない
        if(nice_btn.className === 'done'){
            return;
        }

        const alert_succses = '「いいね」が更新されました。';
        const alert_error = '処理に失敗しました。誠に申し訳ございませんが、改めて「いいね」をお願いいたします。';
        const csrf_value = get_tag_query('input[name="_token"]').value;
        const data = {
            '_token'    : csrf_value,
            'id'        : id_value,
        }

        fetch('/blog/nice_input', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json; charset=utf-8',
            },
            cache: 'no-cache',
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if(data.status === 200){
                cla_add(nice_btn, 'done');
                setCookie();
                niceUp();
                return alert(alert_succses);
            }
            return alert(alert_error);
        })
        .catch((reason) => {
            return alert(alert_error);
        });
    });

    window.addEventListener('DOMContentLoaded', ()=>{
        getCookie();
    });
}