@extends('owner.list')
@section('content')
<article>
    @if(count($blog_comment) > 0)
    <section class="blog_comment_container"> 
        @foreach($blog_comment as $data)
            @if($data['user_type'] === 0 )
                <a href="/owner/blog_comment/{{ $data['id'] }}" class="blog_comments">
                    <div class="comment_name_read">
                        @if(is_null($data['name']))
                            <h6>匿名 様</h6>
                        @else
                            <h6>{{ $data['name'] }} 様</h6>
                        @endif

                        @if($data['del_flg'])
                            <span>非表示</span>
                        @elseif($data['view_flg'])
                            <span>既読</span>
                        @else
                            <span>未読</span>
                        @endif
                    </div>
                    <p>{{ $data['comment'] }}</p>
                </a>
            @else
                <a class="blog_comments_">
                    <h6>{{ $data['name'] }}</h6>
                    <p>{{ $data['comment'] }}</p>
                </a>
            @endif
        @endforeach
    </section>
    @else
        <section style="padding:30px;">
            <h3 style="font-size:26px;text-align:center;">コメントはございません。</h3>
        </section>
    @endif
</article>
@endsection