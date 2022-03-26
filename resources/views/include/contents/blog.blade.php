<section>
    <ul class="item_container">
        @foreach ($blog_lists as $blog_list)
            <li class="blog_item">
                <a href="/blog/#{{$blog_list->id}}">
                    <h3 class="item_title">{{$blog_list->title}}</h3>
                    <div class="item_center">
                        <img class="item_img" src="{{$blog_list->image_path}}" loading="lazy">
                        <div class="item_right">
                            <div class="item_date_col">
                                <span class="material-icons">calendar_today</span>
                                <h6 class="item_date">{{$blog_list->created_at_date}}</h6>
                            </div>
                            <div class="item_date_col">
                                <span class="material-icons">label</span>
                                <p class="item_category">{{$blog_list->category}}</p>
                            </div>
                            <div class="item_nice_col">
                                <span class="material-icons">thumb_up_alt</span>
                                <p class="item_nice">{{$blog_list->nice}}</p>
                            </div>
                        </div>
                    </div>
                    <p class="item_text">{{$blog_list->content}}</p>
                </a>
            </li>
        @endforeach
    </ul>
</section>