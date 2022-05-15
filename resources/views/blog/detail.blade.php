@extends('blog.index')
@section('content')
<article class="blog_container">
    <h1>{{$blog_data->title}}</h1>
    <section class="blog_supplement">
        <div class="supplement_row">
            <span class="material-icons">calendar_today</span>
            <h6 class="item_date">{{$blog_data->date}}</h6>
        </div>
        <div class="supplement_row">
            <span class="material-icons">label</span>
            <p class="item_category">{{$blog_data->category_nm}}</p>
        </div>
        <div class="supplement_row">
            <span class="material-icons">thumb_up_al</span>
            <p id="item_nice">{{$blog_data->nice}}</p>
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

    <section id="nice_btn">
        <p class="nice_btn_text">いいね</p>
    </section>

    @if(count($blog_comment->user) > 0)
        <section class="blog_comment">
            <h2>コメント一覧</h2>

            @include('include.contents.blog.blog_comment',[
                'owner_flg'  => false,
                'owner_nm'   => $owner_data->name,
            ])
        </section>
    @endif

    <!-- チャットコンテンツ -->
    @include('include.contents.chat',
        [
            'about'         => $blog_data->title,
            'btn_nm'        => 'コメント',
            'replyer'       => $owner_data->name,
            'include'       => $chat['include'],
        ]
    )

    <section class="blog_read_end">
        <p style="line-height:24px;">当記事は僕の私見もあるので、もし補足や訂正があれば上記「コメント」または<a href="/contact_mail" class="blog_contact">お問い合わせ</a>からご連絡ください。<br>
        最後まで読んでいただき、ありがとうございました。</p>
    </section>

    <form method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
    </form>
</article>
@endsection