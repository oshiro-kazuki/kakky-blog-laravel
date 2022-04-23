<section>
    <ul class="item_container">
        @foreach ($blog_lists as $blog_list)
            <li class="blog_item">
                @if(isset($owner_flg))
                    <a href="/owner/blog/blog_edit/{{$blog_list->id}}">
                @else
                    <a href="/blog/{{$blog_list->link}}">
                @endif
                        <h3 class="item_title">{{$blog_list->title}}</h3>
                        <div class="item_date">
                            <span class="material-icons">calendar_today</span>
                            <h6>{{$blog_list->created_at_date}}</h6>
                        </div>
                        <div class="item_supplement">
                            <div class="supplement_row">
                                <span class="material-icons">label</span>
                                <p class="item_category">{{$blog_list->category_nm}}</p>
                            </div>
                            <!-- <div class="supplement_row">
                                <span class="material-icons">thumb_up_alt</span>
                                <p class="item_nice">{{$blog_list->nice}}</p>
                            </div> -->
                        </div>
                        @if($loop->first)
                            <img class="item_img" onerror="this.onerror=null;this.src='/img/nophoto.png';" src="{{$blog_list->image_path}}">
                        @else
                            <img loading="lazy" class="item_img" onerror="this.onerror=null;this.src='/img/nophoto.png';" src="{{$blog_list->image_path}}">
                        @endif
                        <p class="item_text">{{$blog_list->content}}</p>
                    </a>
            </li>
        @endforeach
    </ul>
</section>