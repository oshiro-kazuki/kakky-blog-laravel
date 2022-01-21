<article>
    <h3>NEWS</h3>
    <section class="news_items carousel_items_container">
        @if(count($news_lists) > 0)
            @foreach ($news_lists as $news_list)
                <div class="news_item carousel_item">
                    <a href="/news/#{{$news_list->id}}" class="news_item_link carousel_item_link">
                        <h3>{{$news_list->title}}</h3>
                        <p>{{$news_list->content}}</p>
                        <h6>{{$news_list->created_at_date}}</h6>
                    </a>
                </div>
            @endforeach
        @else
            <div class="news_item_none">
                <h6>現在ニュースはありません。</h6>
            </div>
        @endif
    </section>
    <section class="news_btn carousel_btns_container"></section>
    <aside>
        <div id="news_index_btn">
            <a href="/news">NEWS一覧へ</a>
        </div>
    </aside>
</article>