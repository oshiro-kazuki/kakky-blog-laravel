<article>
    <h3>BLOG</h3>
    <section class="blog_items">
        <ul>
            @foreach ($blog_lists as $blog_list)
                <li class="blog_item">
                    <a href="/blog/#{{$blog_list->id}}" class="blog_item_link">
                        <h3 class="item_title">{{$blog_list->title}}</h3>
                        <p class="item_text">{{$blog_list->content_format}}</p>
                        <h6 class="item_date">{{$blog_list->created_at_date}}</h6>
                    </a>
                    <span id="nice" class="material-icons nice">thumb_up_alt</span>
                </li>
            @endforeach
        </ul>
    </section>

    <section id="blog_index_btn">
        <a href="/blog">Blog一覧へ</a>  
    </section>
</article>