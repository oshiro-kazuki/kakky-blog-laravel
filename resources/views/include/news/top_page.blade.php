<article>
    <h3>NEWS</h3>
    <section id="news_items">
        @if(count($news_lists) > 0)
            @foreach ($news_lists as $news_list)
                <div class="news_item" id="{{$news_list->id}}">
                    <a href="/news/#{{$news_list->id}}" class="news_item_link">
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
    <section>
        <div class="news_btn">
            <div id="news_prev_btn">前</div>
            <div id="news_dot_btns"></div>
            <div id="news_next_btn">次</div>
        </div>
    </section>
    <aside>
        <div id="news_index_btn">
            <a href="/news">NEWS一覧へ</a>
        </div>
    </aside>
</article>