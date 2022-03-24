<article>
    <h3>NEWS</h3>
    @if(count($news_lists) > 0)
        <section class="news_items carousel_items_container">
            <ul>
                @foreach ($news_lists as $news_list)
                    <li class="news_item carousel_item">
                        <a href="/news/#{{$news_list->id}}" class="news_item_link carousel_item_link">
                            <h3 class="carousel_item_title">{{$news_list->title}}</h3>
                            <p>{{$news_list->content_format}}</p>
                            <h6 class="carousel_item_date">{{$news_list->created_at_date}}</h6>
                        </a>
                    </li>
                    <span class="carousel_item_content" style="display: none;">{{$news_list->content}}</span>
                @endforeach
            </ul>
        </section>
        <section class="news_dialog_item carousel_dialog_item">
            <h6 class="carousel_dialog_item_date"></h6>
            <span class="carousel_dialog_item_close_btn">×</span>
            <h3 class="carousel_dialog_item_title"></h3>
            <p class="carousel_dialog_item_content"></p>
        </section>
        <section class="carousel_dialog_overray"></section>
    @else
        <section class="news_item_none">
            <h6>現在ニュースはありません。</h6>
        </section>
    @endif
    @if(count($news_lists) > 0)
        <section id="news_index_btn">
            <a href="/news">NEWS一覧へ</a>  
        </section>
    @endif
</article>