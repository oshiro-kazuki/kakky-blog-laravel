@extends('owner.input')
@section('content')
<article>
    <form action="{{ route('blog_input.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section id="input_section" class="form_section">
            <h2>
                <span class="material-icons">grade</span>
                入力画面
                <span class="material-icons">grade</span>
            </h2>
            <!-- メインタイトル -->
            <div class="form_list">
                <label>ブログタイトル<span>必須</span></label>
                <input id="title" type="text" name="title" maxlength="{{$title_length}}" value="{{ old('title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                <p id="title_err">
                    @if ($errors->has('title'))
                        @foreach ($errors->get('title') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif
                </p>
            </div>
            <!-- カテゴリ -->
            <div class="form_list">
                <label>カテゴリ<span>必須</span></label><br>
                <div class="form_select_area">
                    <select id="category" name="category">
                        @foreach ($category_list as $key => $value)
                            <option value="{{$value}}">{{$key}}</option>
                        @endforeach
                    </select>
                    <p id="category_init" class="form_select_text">選択</p>
                </div>
                <p id="category_error">@if ($errors->has('category'))
                        @foreach ($errors->get('category') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>
            <!-- メイン画像 -->
            <div class="form_list">
                <label>トップ画像<span>(3MB以内)</span></label>
                <div class="image_area">
                    <p id="text_image" class="text_image">画像を選択</p>
                    <input id="image" class="form_image" type="file" name="image">
                    <img id="view_image" class="view_image hidden">
                    <div id="edit_image_btn" class="form_edit_image_btn hidden">選択</div>
                    <div id="del_image_btn" class="form_del_image_btn hidden">削除</div>
                </div>
                <p id="image_error">@if ($errors->has('image'))
                        @foreach ($errors->get('image') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <section class="blog_container">
                <div class="form_list">
                    <label>見出し1</label>
                    <input id="origin_title" type="text" name="origin_title" maxlength="{{$title_length}}" value="{{ old('origin_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    <p id="origin_title_err">@if ($errors->has('origin_title'))
                            @foreach ($errors->get('origin_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文1</label>
                    <textarea id="origin_text" name="origin_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('origin_text') }}</textarea>
                    <p id="origin_text_err">@if ($errors->has('origin_text'))
                            @foreach ($errors->get('origin_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>見出し2</label>
                    <input id="accepted_title" type="text" name="accepted_title" maxlength="{{$title_length}}" value="{{ old('accepted_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    <p id="accepted_title_err">@if ($errors->has('accepted_title'))
                            @foreach ($errors->get('accepted_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文2</label>
                    <textarea id="accepted_text" name="accepted_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('accepted_text') }}</textarea>
                    <p id="accepted_text_err">@if ($errors->has('accepted_text'))
                            @foreach ($errors->get('accepted_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>見出し3</label>
                    <input id="but_title" type="text" name="but_title" maxlength="{{$title_length}}" value="{{ old('but_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    <p id="but_title_err">@if ($errors->has('but_title'))
                            @foreach ($errors->get('but_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文3</label>
                    <textarea id="but_text" name="but_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('but_text') }}</textarea>
                    <p id="but_text_err">@if ($errors->has('but_text'))
                            @foreach ($errors->get('but_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>見出し4</label>
                    <input id="conclusion_title" type="text" name="conclusion_title" maxlength="{{$title_length}}" value="{{ old('conclusion_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    <p id="conclusion_title_err">@if ($errors->has('conclusion_title'))
                            @foreach ($errors->get('conclusion_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文4</label>
                    <textarea id="conclusion_text" name="conclusion_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('conclusion_text') }}</textarea>
                    <p id="conclusion_text_err">@if ($errors->has('conclusion_text'))
                            @foreach ($errors->get('conclusion_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
            </section>
            
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
                <p id="title_conf"></p>
            </div>
            <div class="conf_list">
                <label>カテゴリ</label>
                <p id="category_conf"></p>
            </div>
            <div class="conf_list">
                <label>トップ画像</label>
                <div class="image_area">
                    <img id="image_conf" class="view_image" src="/img/nophoto.png">
                </div>
            </div>

            <section class="blog_container">
                <div class="conf_list">
                    <label>見出し1</label>
                    <p id="origin_title_conf"></p>
                </div>
                <div class="conf_list">
                    <label>本文1</label>
                    <p id="origin_text_conf"></p>
                </div>
                <div class="conf_list">
                    <label>見出し2</label>
                    <p id="accepted_title_conf"></p>
                </div>
                <div class="conf_list">
                    <label>本文2</label>
                    <p id="accepted_text_conf"></p>
                </div>
                <div class="conf_list">
                    <label>見出し3</label>
                    <p id="but_title_conf"></p>
                </div>
                <div class="conf_list">
                    <label>本文3</label>
                    <p id="but_text_conf"></p>
                </div>
                <div class="conf_list">
                    <label>見出し4</label>
                    <p id="conclusion_title_conf"></p>
                </div>
                <div class="conf_list">
                    <label>本文4</label>
                    <p id="conclusion_text_conf"></p>
                </div>
            </section>

            <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
            <div id="form_return_btn" class="form_return_btn">戻る</div>
        </section>
    </form>
</article>
@endsection