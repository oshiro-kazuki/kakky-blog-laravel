@extends('owner.input')
@section('content')
<article>
    <form action="{{ route('news_input.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section id="input_section" class="form_section">
            <h2>
                <span class="material-icons">grade</span>
                入力画面
                <span class="material-icons">grade</span>
            </h2>
            <div class="form_list">
                <label>タイトル</label>
                <input id="input_title" type="text" name="title" maxlength="{{$title_length}}" value="{{ old('title') }}" placeholder="タイトルを入力(最大20文字)">
                <p id="title_error">
                    @if ($errors->has('title'))
                        @foreach ($errors->get('title') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="form_list">
                <label>本文</label>
                <textarea id="input_content" type="text" name="content" maxlength="{{$text_length}}" cols="30" rows="10" placeholder="本文を入力(最大140文字)">{{ old('content') }}</textarea>
                <p id="content_error">
                    @if ($errors->has('content'))
                        @foreach ($errors->get('content') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>
            <div id="form_conf_btn" class="form_conf_btn hidden">確認</div>
        </section>
        <section id="conf_section" class="form_section hidden">
            <h2>
                <span class="material-icons">grade</span>
                確認画面
                <span class="material-icons">grade</span>
            </h2>
            <div class="conf_list">
                <label>タイトル</label>
                <p id="conf_title"></p>
            </div>
            <div class="conf_list">
                <label>本文</label>
                <p id="conf_content"></p>
            </div>
            <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
            <div id="form_return_btn" class="form_return_btn">戻る</div>
        </section>
    </form>
</article>
@endsection