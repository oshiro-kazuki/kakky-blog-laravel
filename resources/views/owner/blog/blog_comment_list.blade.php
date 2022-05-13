@extends('owner.list')
@section('content')
<article>
    @if(count($blog_comment->user) > 0)
        <section class="blog_comment_container"> 
            @foreach($blog_comment->user as $user_comment)
                <div class="blog_comment_cassete">
                    <a href="/owner/blog_comment/{{ $user_comment->id }}" class="blog_comments">
                        <div class="comment_name_read">
                            @if(is_null($user_comment->name))
                                <h6>匿名 様</h6><span class="comment_id">ID : {{ $user_comment->id }}</span>
                            @else
                                <h6>{{ $user_comment->name }} 様</h6><span class="comment_id">ID : {{ $user_comment->id }}</span>
                            @endif

                            @if($user_comment->del_flg)
                                <span class="comment_status">非表示</span>
                            @elseif($user_comment->view_flg)
                                <span class="comment_status">既読</span>
                            @else
                                <span class="comment_status">未読</span>
                            @endif
                        </div>

                        <p>{{ $user_comment->comment }}</p>
                    </a>

                    @foreach($blog_comment->owner as $owner_comment)
                        @if($owner_comment->comment_id === $user_comment->id)
                            <a class="blog_comments_">
                                <span class="comment_reply">ID : {{ $user_comment->id }} へ返信</span>
                                <p>{{ $owner_comment->comment }}</p>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </section>
    @else
        <section style="padding:30px;">
            <h3 style="font-size:26px;text-align:center;">コメントはございません。</h3>
        </section>
    @endif
</article>
@endsection