{
    'use strict';
    
    const body = get_tag_query('body');
    const search_btns = document.querySelectorAll('.search_btn');
    const search_modal_views = document.querySelectorAll('.search_modal_view');
    const search_modal = get_tag_byId('search_modal');
    const search_modal_overray = get_tag_byId('search_modal_overray');
    const search_modal_close_btn = get_tag_byId('search_modal_close_btn');
    const search_modal_title = get_tag_byId('search_modal_title');
    let modal_open_flg = false;
    let scrollTop;

    const modalOpen = ()=>{
        cla_remove(search_modal, 'hidden');
        cla_remove(search_modal_overray, 'hidden');
        scrollNone();
        modal_open_flg = true;
    }

    const modalClose = ()=>{
        cla_add(search_modal, 'hidden');
        cla_add(search_modal_overray, 'hidden');
        searchBtnOnTouch();
        searchModalViewsHidden();
        scrollOn();
        modal_open_flg = false;
    }

    const searchBtnOnTouch = ()=>{
        search_btns.forEach((search_btn) => {
            cla_remove(search_btn, 'hidden');
        });
    }

    const searchModalViewsHidden = ()=>{
        search_modal_views.forEach((search_modal_view) => {
            cla_add(search_modal_view, 'hidden');
        });
    }

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

    search_btns.forEach((btn, index) => {
        btn.addEventListener('click', ()=>{
            if(!modal_open_flg){
                modalOpen();
            }
            search_modal_title.textContent = btn.textContent;
            
            search_btns.forEach((search_btn, btn_index)=>{
                if(index === btn_index){
                    cla_add(search_btn, 'hidden');
                }else{
                    cla_remove(search_btn, 'hidden');
                }
            });
            
            search_modal_views.forEach((search_modal_view, view_index)=>{
                if(index === view_index){
                    cla_remove(search_modal_view, 'hidden');
                }else{
                    cla_add(search_modal_view, 'hidden');
                }
            });
        });
    });

    search_modal_overray.addEventListener('click', ()=>{
        modalClose();
    });
    
    search_modal_close_btn.addEventListener('click', ()=>{
        modalClose();
    });
}