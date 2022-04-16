@extends('blog.index')
@section('content')
<aside class="breadcrumb">
    <a href="/">トップ</a>/<a href="/blog">ブログ</a>/<p>{{$blog_data->category}}</p>/<p>{{$blog_data->title}}</p>
</aside>
<article class="blog_container">
    <h1>{{$blog_data->title}}</h1>
    <section class="blog_supplement">
        <div class="supplement_row">
            <span class="material-icons">calendar_today</span>
            <h6 class="item_date">{{$blog_data->date}}</h6>
        </div>
        <div class="supplement_row">
            <span class="material-icons">label</span>
            <p class="item_category">{{$blog_data->category}}</p>
        </div>
    </section>

    <img src="{{$blog_data->image_path}}" class="blog_img" onerror="this.onerror=null;this.src='/img/nophoto.png';">

    <section class="blog_nav_titles">
        <h6>見出し一覧</h6>
        <nav>
            <ol>
                <li><a href="/blog/{{$blog_data->id}}/#origin_title">{{$blog_data->origin_title}}</a></li>
                @if(isset($blog_data->accepted_title))
                    <li><a href="/blog/{{$blog_data->id}}/#accepted_title">{{$blog_data->accepted_title}}</a></li>
                @endif
                @if(isset($blog_data->but_title))
                    <li><a href="/blog/{{$blog_data->id}}/#but_title">{{$blog_data->but_title}}</a></li>
                @endif
                @if(isset($blog_data->conclusion_title))
                    <li><a href="/blog/{{$blog_data->id}}/#conclusion_title">{{$blog_data->conclusion_title}}</a></li>
                @endif
            </ol>
        </nav>
    </section>

    <section class="blog_contents">
        <!-- 見出し１ -->
        <h2 id="origin_title">{{$blog_data->origin_title}}</h2>
        <p>{{$blog_data->origin_text}}</p>

        <!-- 見出し２ -->
        @if(isset($blog_data->accepted_title))
            <h2 id="accepted_title">{{$blog_data->accepted_title}}</h2>
        @endif
        @if(isset($blog_data->accepted_text))
            <p>{{$blog_data->accepted_text}}</p>
        @endif

        <!-- 見出し３ -->
        @if(isset($blog_data->but_title))
            <h2 id="but_title">{{$blog_data->but_title}}</h2>
        @endif
        @if(isset($blog_data->but_text))
            <p>{{$blog_data->but_text}}</p>
        @endif

        <!-- 見出し４ -->
        @if(isset($blog_data->conclusion_title))
            <h2 id="conclusion_title">{{$blog_data->conclusion_title}}</h2>
        @endif
        @if(isset($blog_data->conclusion_text))
            <p>{{$blog_data->conclusion_text}}</p>
        @endif
    </section>

    @if(isset($blog_data->reference))
        <section class="blog_reference">
            <h6>参考リンク</h2>
            <ul>
                @foreach($blog_data->reference as $list)
                    <li><a href="{{ $list['link'] }}">{{ $list['title']}}</a></li>
                @endforeach
            </ul>
        </section>
    @endif

    <!-- <section class="supplement_row">
        <span class="material-icons">thumb_up_alt</span>
        <p class="item_nice">{{$blog_data->nice}}</p>
    </section> -->

    <section class="blog_read_end">
        <p>当記事は僕の私見もあるので、あくまでもご参考程度にお読みください。<br>
            最後まで読んでいただき、ありがとうございました。</p>
    </section>
</article>
@endsection