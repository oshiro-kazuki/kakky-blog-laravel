<section>
    <div id="chat_btn">{{ $btn_nm }}</div>
    <span id="chat_name" style="display:none;">{{ $replyer }}</span>

    <div id="chat_modal" class="hidden">
        <div class="chat_about">{{ $about }}について</div>

        <div id="chat_room"></div>

        <p class="chat_reflection">※反映には少々お時間がかかります。</p>

        <textarea id="chat_input_name" maxlength="{{ $include['length']['name'] }}" placeholder="最大{{ $include['length']['name'] }}文字" class="chat_input"></textarea>
        <textarea id="chat_input_email" maxlength="{{ $include['length']['email'] }}" placeholder="最大{{ $include['length']['email'] }}文字" class="chat_input hidden"></textarea>
        <textarea id="chat_input_comment" maxlength="{{ $include['length']['comment'] }}" placeholder="最大{{ $include['length']['comment'] }}文字" class="chat_input hidden"></textarea>
        
        <p id="comment_error"></p>

        <div class="chat_btn_area">
            <div id="comment_post_btn" class="btn post_btn hidden">投稿</div>
            <div id="comment_skip_btn" class="btn skip_btn">スキップ</div>
        </div>

        <div id="chat_modal_close_btn" class="btn close_btn">閉じる</div>    
    </div>
    <div id="chat_modal_overray" class="hidden"></div>
</section>