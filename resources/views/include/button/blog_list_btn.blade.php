<a href="/blog/list" id="blog_list_btn">ブログ一覧へ</a>
<script>
    (function () {
        const blog_list_btn = document.getElementById('blog_list_btn');
        const op = {
            root: null,
            rootMargin: '0px',
            threshold: 0
        }
        const cb = (entries, object)=>{
            if(entries[0].isIntersecting){
                blog_list_btn.style.margin = '50px auto 0';
                blog_list_btn.style.paddingBottom = '50px';
                blog_list_btn.style.display = 'block';
                blog_list_btn.style.height = '50px';
                blog_list_btn.style.width = '300px';
                blog_list_btn.style.fontSize = '20px';
                blog_list_btn.style.fontWeight = 'bold';
                blog_list_btn.style.textAlign = 'center';
                blog_list_btn.style.lineHeight = '50px';
                blog_list_btn.style.color = 'white';
                blog_list_btn.style.backgroundColor = 'tomato';
                blog_list_btn.style.borderRadius = '8px';
                blog_list_btn.style.boxShadow = '4px 4px 4px #ccc';
                object.unobserve(entries[0].target);
            }
        }
        const ib = new IntersectionObserver(cb, op);
        ib.observe(blog_list_btn);
    }());
</script>