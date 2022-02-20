<article>
    <h3>NEWS</h3>
    @if(count($news_lists) > 0)
        <section class="news_items carousel_items_container">
            <ul>
                @foreach ($news_lists as $news_list)
                    <li class="news_item carousel_item">
                        <a href="/news/#{{$news_list->id}}" class="news_item_link carousel_item_link">
                            <h3 class="carousel_item_title">{{$news_list->title}}</h3>
                            <p class="carousel_item_content">{{$news_list->content}}</p>
                            <h6 class="carousel_item_date">{{$news_list->created_at_date}}</h6>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
        <section class="news_dialog_container carousel_dialog_container">
            <div class="news_dialog_item carousel_dialog_item">
                <h6 class="carousel_dialog_item_date"></h6>
                <span class="carousel_dialog_item_close_btn">×</span>
                <h3 class="carousel_dialog_item_title"></h3>
                <p class="carousel_dialog_item_content"></p>
            </div>
        </section>
    @else
        <section class="news_item_none">
            <h6>現在ニュースはありません。</h6>
        </section>
    @endif
    @if(count($news_lists) > 0)
        <aside id="news_index_btn">
            <a href="/news">NEWS一覧へ</a>  
        </aside>
    @endif
</article>