@if($owner_flg)
    <span class="comment_reply">ID : {{ $user_comment->id }} へ返信</span>
@else
    <h6>{{ $owner_nm }}</h6>
@endif

<p>{{ $owner_comment->comment }}</p>