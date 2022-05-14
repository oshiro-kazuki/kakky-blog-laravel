@extends('owner.list')
@section('content')
<article>
    @if(count($blog_comment->user) > 0)
        @include('include.contents.blog.blog_comment', ['owner_flg' => true])
    @else
        <section style="padding:30px;">
            <h3 style="font-size:26px;text-align:center;">コメントはございません。</h3>
        </section>
    @endif
</article>
@endsection