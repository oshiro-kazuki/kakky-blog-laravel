<article>
    <h3>NEWS</h3>
    @if(count($news_lists) > 0)
        <section class="news_items carousel_items_container">
            <ul>
                @foreach ($news_lists as $news_list)
                    <li class="news_item carousel_item">
                        <a href="/news/#{{$news_list->id}}" class="news_item_link carousel_item_link">
                            <h3>{{$news_list->title}}</h3>
                            <p>{{$news_list->content}}</p>
                            <h6>{{$news_list->created_at_date}}</h6>
                        </a>
                    </li>
                @endforeach
            </ul>
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