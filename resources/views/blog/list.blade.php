@extends('blog.index')
@section('content')
<article>
    <h2 style="font-size:26px;font-weight:bold;text-align:center;padding-bottom:30px;">{{ $title }}</h2>
    @if(count($blog_lists) > 0)
        <section class="blog_list_container">
            <div class="blog_list_cassete">
                @include('include.contents.blog_cassette')
            </div>
    
            @if(isset($search_flg) && $search_flg)
                <section id="search_menu">
                    @if($category_list !== '')
                        <div class="search_btn">カテゴリーから探す</div>
                    @endif
                </section>
    
                <section id="search_modal" class="hidden">
                    <p id="search_modal_title"></p>
                    @if($category_list !== '')
                        <div class="search_modal_view category hidden">
                            @foreach($category_list as $list)
                                <div>
                                    <a href="/blog/{{ $list->category }}" class="search_modal_btn">{{ $list->category_nm }}</a>
                                    <span class="search_modal_count">({{ $list->category_count }}件)</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
    
                    <div id="search_modal_close_btn">閉じる</div>    
                </section>
    
                <section id="search_modal_overray" class="hidden"></section>
            @endif
        </section>
    @else
        <section style="padding:30px;text-align:center;">
            <h3 style="font-size:26px;">現在、表示できるブログはございません。</h3>
        </section>
    @endif
</article>
@endsection