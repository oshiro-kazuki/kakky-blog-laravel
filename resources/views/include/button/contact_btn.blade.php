<a href="/info/contact_mail/" id="contact_btn">お問い合わせ</a>
<script>
    (function () {
        const contact_btn = document.getElementById('contact_btn');
        const op = {
            root: null,
            rootMargin: '0px',
            threshold: 0
        }
        const cb = (entries, object)=>{
            if(entries[0].isIntersecting){
                contact_btn.style.margin = '50px auto 0';
                contact_btn.style.paddingBottom = '50px';
                contact_btn.style.display = 'block';
                contact_btn.style.height = '50px';
                contact_btn.style.width = '300px';
                contact_btn.style.fontSize = '20px';
                contact_btn.style.fontWeight = 'bold';
                contact_btn.style.textAlign = 'center';
                contact_btn.style.lineHeight = '50px';
                contact_btn.style.color = 'white';
                contact_btn.style.backgroundColor = 'tomato';
                contact_btn.style.borderRadius = '8px';
                contact_btn.style.boxShadow = '4px 4px 4px #ccc';
                object.unobserve(entries[0].target);
            }
        }
        const ib = new IntersectionObserver(cb, op);
        ib.observe(contact_btn);
    }());
</script>