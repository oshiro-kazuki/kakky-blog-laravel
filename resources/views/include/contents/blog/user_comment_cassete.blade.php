<div class="comment_name_read">
    @if(is_null($user_comment->name))
        <h6>匿名 様</h6>
    @else
        <h6>{{ $user_comment->name }} 様</h6>
    @endif

    @if($owner_flg)
        <span class="comment_id">ID : {{ $user_comment->id }}</span>

        @if($user_comment->del_flg)
            <span class="comment_status">非表示</span>
        @elseif($user_comment->view_flg)
            <span class="comment_status">既読</span>
        @else
            <span class="comment_status">未読</span>
        @endif
    @endif
</div>

<p>{{ $user_comment->comment }}</p>