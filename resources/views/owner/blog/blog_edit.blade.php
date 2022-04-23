@extends('owner.input')
@section('content')
<article>
    <form action="{{ route('blog_edit.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$blog_data->id}}">
        <input id="image_flg" type="hidden" name="image_flg" value="{{$blog_data->image_flg}}">
        <section id="input_section" class="form_section">
            <h2>
                <span class="material-icons">grade</span>
                編集画面
                <span class="material-icons">grade</span>
            </h2>
            <!-- メインタイトル -->
            <div class="form_list">
                <label>ブログタイトル<span>必須</span></label>
                @if(old('title') === null)
                    <input id="title" type="text" name="title" maxlength="{{$title_length}}" value="{{$blog_data->title}}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                @else
                    <input id="title" type="text" name="title" maxlength="{{$title_length}}" value="{{ old('title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                @endif
                <p id="title_err">@if ($errors->has('title'))
                            @foreach ($errors->get('title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
            </div>
            <!-- カテゴリ -->
            <div class="form_list">
                <label>カテゴリ<span>必須</span></label><br>
                <div class="form_select_area">
                    <select id="category" name="category">
                        @foreach ($category_list as $key => $value)
                            @if(old('category') === null && $blog_data->category == $key)
                                <option value="{{$value}}" selected>{{$key}}</option>
                            @elseif(old('category') == $value)
                                <option value="{{$value}}" selected>{{$key}}</option>
                            @else
                                <option value="{{$value}}">{{$key}}</option>
                            @endif
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
                    @if($blog_data->image_flg)
                        <p id="text_image" class="text_image hidden">画像を選択</p>
                        <input id="image" class="form_image hidden" type="file" name="image">
                        <img id="view_image" class="view_image" src="{{$blog_data->image_path}}" onerror="this.onerror=null;this.src='/img/nophoto.png';">
                        <div id="edit_image_btn" class="form_edit_image_btn">選択</div>
                        <div id="del_image_btn" class="form_del_image_btn">削除</div>
                    @else
                        <p id="text_image" class="text_image">画像を選択</p>
                        <input id="image" class="form_image" type="file" name="image">
                        <img id="view_image" class="view_image hidden" >
                        <div id="edit_image_btn" class="form_edit_image_btn hidden">選択</div>
                        <div id="del_image_btn" class="form_del_image_btn hidden">削除</div>
                    @endif
                </div>
                <p id="image_error">@if ($errors->has('image'))
                        @foreach ($errors->get('image') as $detail_errors)
                            {{$detail_errors}}
                        @endforeach
                    @endif</p>
            </div>

            <section class="blog_container">
                <div class="form_list">
                    <label>見出し1<span>必須</span></label>
                    @if(old('origin_title') === null)
                        <input id="origin_title" type="text" name="origin_title" maxlength="{{$title_length}}" value="{{ $blog_data->origin_title }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="origin_title" type="text" name="origin_title" maxlength="{{$title_length}}" value="{{ old('origin_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="origin_title_err">@if ($errors->has('origin_title'))
                            @foreach ($errors->get('origin_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文1<span>必須</span></label>
                    @if(old('origin_text') === null)
                        <textarea id="origin_text" name="origin_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ $blog_data->origin_text }}</textarea>
                    @else
                        <textarea id="origin_text" name="origin_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('origin_text') }}</textarea>
                    @endif
                    <p id="origin_text_err">@if ($errors->has('origin_text'))
                            @foreach ($errors->get('origin_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>見出し2</label>
                    @if(old('accepted_title') === null)
                        <input id="accepted_title" type="text" name="accepted_title" maxlength="{{$title_length}}" value="{{ $blog_data->accepted_title }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="accepted_title" type="text" name="accepted_title" maxlength="{{$title_length}}" value="{{ old('accepted_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="accepted_title_err">@if ($errors->has('accepted_title'))
                            @foreach ($errors->get('accepted_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文2</label>
                    @if(old('accepted_text') === null)
                        <textarea id="accepted_text" name="accepted_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ $blog_data->accepted_text }}</textarea>
                    @else
                        <textarea id="accepted_text" name="accepted_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('accepted_text') }}</textarea>
                    @endif
                    <p id="accepted_text_err">@if ($errors->has('accepted_text'))
                            @foreach ($errors->get('accepted_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>見出し3</label>
                    @if(old('but_title') === null)
                        <input id="but_title" type="text" name="but_title" maxlength="{{$title_length}}" value="{{ $blog_data->but_title }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="but_title" type="text" name="but_title" maxlength="{{$title_length}}" value="{{ old('but_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="but_title_err">@if ($errors->has('but_title'))
                            @foreach ($errors->get('but_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文3</label>
                    @if(old('but_text') === null)
                        <textarea id="but_text" name="but_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ $blog_data->but_text }}</textarea>
                    @else
                        <textarea id="but_text" name="but_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('but_text') }}</textarea>
                    @endif
                    <p id="but_text_err">@if ($errors->has('but_text'))
                            @foreach ($errors->get('but_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>見出し4</label>
                    @if(old('conclusion_title') === null)
                        <input id="conclusion_title" type="text" name="conclusion_title" maxlength="{{$title_length}}" value="{{ $blog_data->conclusion_title }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="conclusion_title" type="text" name="conclusion_title" maxlength="{{$title_length}}" value="{{ old('conclusion_title') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="conclusion_title_err">@if ($errors->has('conclusion_title'))
                            @foreach ($errors->get('conclusion_title') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>本文4</label>
                    @if(old('conclusion_text') === null)
                        <textarea id="conclusion_text" name="conclusion_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ $blog_data->conclusion_text }}</textarea>
                    @else
                        <textarea id="conclusion_text" name="conclusion_text" maxlength="{{$text_length}}" placeholder="本文を入力(最大{{$text_length}}文字)">{{ old('conclusion_text') }}</textarea>
                    @endif
                    <p id="conclusion_text_err">@if ($errors->has('conclusion_text'))
                            @foreach ($errors->get('conclusion_text') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>参考リンク1タイトル</label>
                    @if(old('reference_text1') === null)
                        <input id="reference_text1" type="text" name="reference_text1" maxlength="{{$title_length}}" value="{{ $blog_data->reference_text1 }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="reference_text1" type="text" name="reference_text1" maxlength="{{$title_length}}" value="{{ old('reference_text1') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="reference_text1_err">@if ($errors->has('reference_text1'))
                            @foreach ($errors->get('reference_text1') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>参考リンク1URL</label>
                    @if(old('reference_link1') === null)
                        <input id="reference_link1" type="text" name="reference_link1" maxlength="{{$title_length}}" value="{{ $blog_data->reference_link1 }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="reference_link1" type="text" name="reference_link1" maxlength="{{$title_length}}" value="{{ old('reference_link1') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="reference_link1_err">@if ($errors->has('reference_link1'))
                            @foreach ($errors->get('reference_link1') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>参考リンク2タイトル</label>
                    @if(old('reference_text2') === null)
                        <input id="reference_text2" type="text" name="reference_text2" maxlength="{{$title_length}}" value="{{ $blog_data->reference_text2 }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="reference_text2" type="text" name="reference_text2" maxlength="{{$title_length}}" value="{{ old('reference_text2') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="reference_text2_err">@if ($errors->has('reference_text2'))
                            @foreach ($errors->get('reference_text2') as $detail_errors)
                                {{ $detail_errors }}
                            @endforeach
                        @endif</p>
                </div>
                <div class="form_list">
                    <label>参考リンク2URL</label>
                    @if(old('reference_link2') === null)
                        <input id="reference_link2" type="text" name="reference_link2" maxlength="{{$title_length}}" value="{{ $blog_data->reference_link2 }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @else
                        <input id="reference_link2" type="text" name="reference_link2" maxlength="{{$title_length}}" value="{{ old('reference_link2') }}" placeholder="タイトルを入力(最大{{$title_length}}文字)">
                    @endif
                    <p id="reference_link2_err">@if ($errors->has('reference_link2'))
                            @foreach ($errors->get('reference_link2') as $detail_errors)
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
                    @if($blog_data->image_flg)
                        <img id="image_conf" class="view_image" src="{{$blog_data->image_path}}" onerror="this.onerror=null;this.src='/img/nophoto.png';">
                    @else
                        <img id="image_conf" class="view_image" src="/img/nophoto.png">
                    @endif
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
                <div class="conf_list">
                    <label>参考リンク1タイトル</label>
                    <p id="reference_text1_conf"></p>
                </div>
                <div class="conf_list">
                    <label>参考リンク1URL</label>
                    <p id="reference_link1_conf"></p>
                </div>
                <div class="conf_list">
                    <label>参考リンク2タイトル</label>
                    <p id="reference_text2_conf"></p>
                </div>
                <div class="conf_list">
                    <label>参考リンク2URL</label>
                    <p id="reference_link2_conf"></p>
                </div>
            </section>

            <button id="submit_btn" type="submit" class="form_submit_btn" disabled>送信</button>
            <div id="form_return_btn" class="form_return_btn">戻る</div>
        </section>
    </form>
</article>
@endsection