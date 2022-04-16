@extends('owner.list')
@section('content')
<article>
    @if(count($blog_lists) > 0)
        @include('include.contents.blog_cassette')
    @else
        <section style="padding:30px;">
            <h3 style="font-size:26px;text-align:center;">投稿されたブログはございません。</h3>
        </section>
    @endif
</article>
@endsection