'use strict';

// トップ画像共通処理
const top_image_array_roop = (pattern, array, count = false, positionX = false, positionY = false) => {
    for(let i = 0; i < array.length; i++) {
        switch(pattern) {
            case "init" :
                array[i].tag.style.backgroundImage = `url(${array[i].src})`
                if(i > 0) {
                    cla_add(array[i].tag, "hidden");
                }
                break;

            case "swiching" :
                cla_add(array[i].tag, "hidden");
                if(count === i) {
                    cla_remove(array[i].tag, "hidden");
                }
                break;

            case "slide" :
                if(count === i) {
                    // positionX += .5;
                    array[i].tag.style.backgroundPosition = `${positionX}% ${positionY}%`;
                }
                break;
                
            default :
                break;
        }
    }
}

window.addEventListener('DOMContentLoaded', function () {
    const header = get_tag_query('header');
    const top_image = get_tag_byId('top_image');
    const top_image1 = create_tag('div', top_image, false, "top_image1");
    const top_image2 = create_tag('div', top_image, false, "top_image2");
    const top_image3 = create_tag('div', top_image, false, "top_image3");
    
    // 画像の情報を配列化
    const top_image_array = [
        {tag: top_image1, src: "/img/top_image1.jpg"},
        {tag: top_image2, src: "/img/top_image2.jpg"},
        {tag: top_image3, src: "/img/top_image3.jpg"},
    ];
    
    // 画像の初期設定
    top_image_array_roop("init", top_image_array);
    
    // 画像高さ指定
    const screenH = window.innerHeight - header.clientHeight;
    top_image.style.height = `${screenH}px`;
    
    // 画像切り替え
    let image_count = 0;
    let positionX = 70;
    let positionY = 50;
    setInterval(() => {
        positionX = 70;
        // カウント加減
        if(image_count < top_image_array.length -1) {
            image_count++
        } else {
            image_count = 0;
        }
    
        top_image_array_roop("swiching", top_image_array, image_count);
    }, 3000);
    
    //　画像スライド
    setInterval(() => {
        positionX += .5;
        top_image_array_roop("slide", top_image_array, image_count, positionX, positionY);
    }, 100);
});