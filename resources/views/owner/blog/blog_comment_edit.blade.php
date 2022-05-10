@extends('owner.input')
@section('content')
<article>
    <section class="blog_comment_contant">
        <h3>コメント内容</h3>
        
        @if(is_null($blog_comment->name))
            <h6>匿名 様</h6>
        @else
            <h6>{{ $blog_comment->name }} 様</h6>
        @endif
        
        <p>{{ $blog_comment->comment }}</p>
        
        <!-- ブログ詳細のリンクも記載 -->
        <span>ブログリンク</span>
        <a href="http://localhost:8000/blog/tourism/8">ブログリンクfdfdfdfdf</a>
    </section>

    <section>
        <form action="{{ route('blog_comment.reply') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $blog_comment->id }}">
            <input type="hidden" name="blog_id" value="{{ $blog_comment->blog_id }}">
    
            <section id="input_section" class="form_section">
                <h2>返答画面</h2>
    
                <div class="form_list">
                    <label>コメント<span>必須</span></label>
                    <textarea id="comment" name="comment" maxlength="{{ $comment_length }}" placeholder="最大{{ $comment_length }}文字"></textarea>
                    <p id="comment_err">@if ($errors->has('comment'))
                            @foreach ($errors->get('comment') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
    
                <div id="form_conf_btn" class="form_conf_btn hidden">確認</div>
            </section>
    
            <section id="conf_section" class="form_section hidden">
                <h2>確認画面</h2>
    
                <div class="conf_list">
                    <label>コメント</label>
                    <p id="comment_conf"></p>
                </div>
    
                <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
                <div id="form_return_btn" class="form_return_btn">戻る</div>
            </section>
        </form>
    </section>

    <section>
        <div class="status_hide">
            <form action="{{ route('blog_comment.del') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $blog_comment->id }}">
                <input type="hidden" name="del_flg" value="{{ $blog_comment->del_flg }}">

                <button id="hidden_btn" type="submit" class="form_submit_btn">{{ $del_message }}</button>
            </form>
        </div>
    </section>
</article>
@endsection