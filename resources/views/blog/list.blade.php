@extends('blog.index')
@section('content')
<article>
    <h2 style="font-size:26px;font-weight:bold;text-align:center;padding-bottom:30px;">ブログ一覧</h2>
    @if(count($blog_lists) > 0)
        @include('include.contents.blog')
    @else
        <section style="padding:30px;">
            <h3 style="font-size:26px;">現在、表示できるブログはございません。</h3>
        </section>
    @endif
</article>
@endsection