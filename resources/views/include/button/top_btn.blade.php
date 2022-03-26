<a href="/" id="top_btn">トップ画面へ</a>
<script>
    (function () {
        const top_btn = document.getElementById('top_btn');
        const op = {
            root: null,
            rootMargin: '0px',
            threshold: 0
        }
        const cb = (entries, object)=>{
            if(entries[0].isIntersecting){
                top_btn.style.margin = '50px auto 0';
                top_btn.style.paddingBottom = '50px';
                top_btn.style.display = 'block';
                top_btn.style.height = '50px';
                top_btn.style.width = '300px';
                top_btn.style.fontSize = '20px';
                top_btn.style.fontWeight = 'bold';
                top_btn.style.textAlign = 'center';
                top_btn.style.lineHeight = '50px';
                top_btn.style.color = 'white';
                top_btn.style.backgroundColor = 'tomato';
                top_btn.style.borderRadius = '8px';
                top_btn.style.boxShadow = '4px 4px 4px #ccc';
                object.unobserve(entries[0].target);
            }
        }
        const ib = new IntersectionObserver(cb, op);
        ib.observe(top_btn);
    }());
</script>