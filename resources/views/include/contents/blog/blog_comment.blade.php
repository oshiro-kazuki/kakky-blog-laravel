<section class="blog_comment_container"> 
    @foreach($blog_comment->user as $user_comment)
        @if($owner_flg || !$owner_flg && !$user_comment->del_flg)
            <div class="blog_comment_cassete">
                @if($owner_flg)
                    <a href="/owner/blog_comment/{{ $user_comment->id }}" class="blog_comments">
                        @include('include.contents.blog.user_comment_cassete')
                    </a>
                @else
                    <div class="blog_comments">
                        @include('include.contents.blog.user_comment_cassete')
                    </div>
                @endif

                @if(count($blog_comment->owner) > 0)
                    @foreach($blog_comment->owner as $owner_comment)
                        @if($owner_comment->comment_id === $user_comment->id)
                            @if($owner_flg)
                                <a class="blog_comments_">
                                    @include('include.contents.blog.owner_comment_cassete')
                                </a>
                            @else
                                <div class="blog_comments_">
                                    @include('include.contents.blog.owner_comment_cassete')
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif
            </div>
        @endif
    @endforeach
</section>