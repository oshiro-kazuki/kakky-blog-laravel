{
    'use strict';

    const body = get_tag_query('body');
    const chat_btn = get_tag_byId('chat_btn');
    const chat_modal = get_tag_byId('chat_modal');
    const chat_input_name = get_tag_byId('chat_input_name');
    const chat_input_email = get_tag_byId('chat_input_email');
    const chat_input_comment = get_tag_byId('chat_input_comment');
    const comment_error = get_tag_byId('comment_error');
    const comment_post_btn = get_tag_byId('comment_post_btn');
    const comment_skip_btn = get_tag_byId('comment_skip_btn');
    const chat_modal_close_btn = get_tag_byId('chat_modal_close_btn');
    const chat_modal_overray = get_tag_byId('chat_modal_overray');
    const chat_room = get_tag_byId('chat_room');
    const chat_name = get_tag_byId('chat_name').textContent;

    // チャットコメント
    const length_name       = chat_input_name.getAttribute('maxlength');
    const length_email      = chat_input_email.getAttribute('maxlength');
    const length_comment    = chat_input_comment.getAttribute('maxlength');
    const message_name      = 'ご愛読ありがとうございます。先にお名前をお伺いしてもよろしいでしょうか？(スキップしても良いです)';
    const message_email     = 'ありがとうございます。ご連絡用のメールアドレスのご入力をお願いします。(スキップしても良いです)';
    const message_comment   = 'ありがとうございます。最後にコメントのご入力をお願いいたします。';
    const message_last      = 'コメントありがとうございました。今後ともkakky-blogをよろしくお願いいたします。';

    // ユーザー情報
    let user_name       = '';
    let user_email      = '';
    let user_comment    = '';
    const skip_name     = '匿名';

    // 画面動作設定
    const timeout           = 1000;                 // 1秒に設定
    let commennt_res_arr    = [true, true, true];   // trueはエラー
    let comment_count       = 0;                    // コメント用カウント         
    let comment_limit       = 3;                    // コメント用リミット        
    let scrollTop;

    const scrollNone = ()=>{
        scrollTop = window.scrollY;
        body.style.position = 'fixed';
        body.style.top = `${-scrollTop}px`;
    }

    const scrollOn = ()=>{
        body.style.position = '';   
        body.style.top = '';
        window.scrollTo(0, scrollTop);
    }

    const modalOpen = ()=>{
        cla_remove(chat_modal, 'hidden');
        cla_remove(chat_modal_overray, 'hidden');
        scrollNone();
    }

    const modalClose = ()=>{
        cla_add(chat_modal, 'hidden');
        cla_add(chat_modal_overray, 'hidden');
        scrollOn();
        deleteComments();
        skipBtnOnTouch();
    }

    const postBtnOnTouch = ()=>{
        cla_remove(comment_post_btn, 'hidden');
    }

    const postBtnNoTouch = ()=>{
        cla_add(comment_post_btn, 'hidden');
    }

    const skipBtnOnTouch = ()=>{
        cla_remove(comment_skip_btn, 'hidden');
    }

    const skipBtnNoTouch = ()=>{
        cla_add(comment_skip_btn, 'hidden');
    }

    const createComment_ = (text)=>{
        setTimeout(() => {
            const div = create_tag('div', chat_room, false, 'chat_user_');
            create_tag('p', div, chat_name, 'chat_name');
            create_tag('p', div, text, 'chat_comment');
        }, timeout);
    }

    const createComment_User = (name, text)=>{
        const is_name = name === '' ? skip_name : name;
        const div = create_tag('div', chat_room, false, 'chat_user');
        create_tag('p', div, is_name, 'chat_name');
        create_tag('p', div, text, 'chat_comment');
    }

    const deleteComments = ()=>{
        const chat_user_s = document.querySelectorAll('.chat_user_');
        if(chat_user_s.length > 0){
            chat_user_s.forEach(chat_user_ =>{
                chat_user_.remove();
            });
        }
        
        const chat_users = document.querySelectorAll('.chat_user');
        if(chat_users.length > 0){
            chat_users.forEach(chat_user =>{
                chat_user.remove();
            });
        }
    }

    const textareaDisplay = (hidden, hidden1, open, all = false)=>{
        if(all){
            cla_add(hidden, 'hidden');
            cla_add(hidden1, 'hidden');
            cla_add(open, 'hidden');
        }else{
            cla_add(hidden, 'hidden');
            cla_add(hidden1, 'hidden');
            cla_remove(open, 'hidden');
        }
    }

    chat_modal_overray.addEventListener('click', ()=>{
        modalClose();
    });
    
    chat_modal_close_btn.addEventListener('click', ()=>{
        modalClose();
    });

    chat_btn.addEventListener('click', ()=>{
        modalOpen();
        createComment_(message_name);
    });

    // 名前の入力
    chat_input_name.addEventListener('input', (e)=>{
        commennt_res_arr[0] = nullMaxCheck(e, comment_error, length_name);
        if(commennt_res_arr[0]){
            postBtnNoTouch(); // 投稿ボタン非活性化
        }else{
            postBtnOnTouch(); // 投稿ボタン活性化
        }
    });

    // メールアドレスの入力
    chat_input_email.addEventListener('input', (e)=>{
        commennt_res_arr[1] = nullMaxCheck(e, comment_error, length_email);
        if(commennt_res_arr[1]){
            postBtnNoTouch(); // 投稿ボタン非活性化
        }else{
            postBtnOnTouch(); // 投稿ボタン活性化
        }
    });

    // コメントの入力
    chat_input_comment.addEventListener('input', (e)=>{
        commennt_res_arr[2] = nullMaxCheck(e, comment_error, length_comment);
        if(commennt_res_arr[2]){
            postBtnNoTouch(); // 投稿ボタン非活性化
        }else{
            postBtnOnTouch(); // 投稿ボタン活性化
        }
    });

    comment_post_btn.addEventListener('click', ()=>{   
        if(comment_count >= comment_limit){
            return;
        }

        const post_btn_res = comment_post_btn.className.includes('hidden');
        if(!post_btn_res && !commennt_res_arr[comment_count] && comment_count === 0){
            // 名前の投稿
            user_name = chat_input_name.value;
            createComment_User(user_name, user_name);
            textareaDisplay(chat_input_name, chat_input_comment, chat_input_email); // メールアドレスを表示
            postBtnNoTouch();   // 投稿ボタン非活性化
            ++comment_count;
            createComment_(message_email);
        }   

        if(!post_btn_res && !commennt_res_arr[comment_count] && comment_count === 1){
            // メールアドレスの投稿
            user_email = chat_input_email.value;
            createComment_User(user_name, user_email);
            textareaDisplay(chat_input_name, chat_input_email, chat_input_comment); // コメントを表示
            postBtnNoTouch();   // 投稿ボタン非活性化
            skipBtnNoTouch();   // スキップボタン非活性化
            ++comment_count;
            createComment_(message_comment);
        }

        if(!post_btn_res && !commennt_res_arr[comment_count] && comment_count === 2){
            // コメントの投稿
            user_comment = chat_input_comment.value;
            createComment_User(user_name, user_comment);
            textareaDisplay(chat_input_email, chat_input_comment, chat_input_name, true); // 名前を表示
            postBtnNoTouch();   // 投稿ボタン非活性化
            skipBtnNoTouch();   // スキップボタン非活性化
            createComment_(message_last);
        }
    });
}