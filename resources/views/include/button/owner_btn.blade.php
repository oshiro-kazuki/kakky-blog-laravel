<a href="/owner" id="owner_btn">オーナー画面へ</a>
<script>
    (function () {
        const owner_btn = document.getElementById('owner_btn');
        const op = {
            root: null,
            rootMargin: '0px',
            threshold: 0
        }
        const cb = (entries, object)=>{
            if(entries[0].isIntersecting){
                owner_btn.style.margin = '50px auto 0';
                owner_btn.style.paddingBottom = '50px';
                owner_btn.style.display = 'block';
                owner_btn.style.height = '50px';
                owner_btn.style.width = '300px';
                owner_btn.style.fontSize = '20px';
                owner_btn.style.fontWeight = 'bold';
                owner_btn.style.textAlign = 'center';
                owner_btn.style.lineHeight = '50px';
                owner_btn.style.color = 'white';
                owner_btn.style.backgroundColor = 'navy';
                owner_btn.style.borderRadius = '8px';
                owner_btn.style.boxShadow = '4px 4px 4px #ccc';
                object.unobserve(entries[0].target);
            }
        }
        const ib = new IntersectionObserver(cb, op);
        ib.observe(owner_btn);
    }());
</script>