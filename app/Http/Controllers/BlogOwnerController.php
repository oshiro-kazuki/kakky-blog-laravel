<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Libs\Blog;

class BlogOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
        $this->title_length      = config('const.TEXT_LENGTH20');
        $this->text_length       = config('const.TEXT_LENGTH1000');
        $this->blog = new Blog();
        $this->image_path = $this->blog->image_path;
        $this->image_file = $this->blog->image_file;
    }

    // ブログ投稿画面表示
    public function showinput()
    {
        $style = [
            '/css/owner/blog_input.css',
        ];
        $script = [
            'js/owner/blog_input.js',
        ];
        return view('.owner.blog.blog_input',
        [
            'screen_title'  => 'ブログ投稿画面',
            'category_list' => $this->get_category(),
            'style'         => $style,
            'script'        => $script,
            'title_length'  => $this->title_length,
            'text_length'   => $this->text_length,
        ]);
    }

    // ブログ投稿処理
    public function blogPost(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect('/owner/blog/blog_input')->withErrors($validator)->withInput();
        }

        $postData = $request->all();
        
        $postData['image_flg'] = false;

        if(!is_null($request['image'])){
            $postData['image_flg'] = true;
            $file = $request['image'];
            $this->imageStock($file);
        }

        $this->blog->blogInsert($postData);

        return redirect('/owner');
    }

    // ブログ一覧画面表示
    public function showList()
    {
        $blog_data = $this->getBlogList();

        return view('.owner.blog.blog_list',
            [
                'screen_title' => 'ブログ一覧(管理)',
                'blog_lists'   => $blog_data['list'],
                'blog_css'     => $blog_data['css'],
                'owner_flg'    => true,
            ]
        );
    }

    // ブログ編集画面表示
    public function showEdit($id)
    {
        $blog_data = $this->getBlogDetail($id);

        if(!isset($blog_data)){
            return view('error.none_page');
        }

        $style = [
            '/css/owner/blog_input.css',
        ];
        $script = [
            'js/owner/blog_input.js',
        ];
        return view('.owner.blog.blog_edit',
        [
            'screen_title'  => 'ブログ編集画面',
            'blog_data'     => $blog_data,
            'category_list' => $this->get_category(),
            'style'         => $style,
            'script'        => $script,
            'title_length'  => $this->title_length,
            'text_length'   => $this->text_length,
        ]);
    }

    public function blogEdit(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect('/owner/blog/blog_input')->withErrors($validator)->withInput();
        }

        $postData = $request->all();

        if($postData['image_flg'] === '1'){ // 画像が更新または維持された場合
            $postData['image_flg'] = true;
            if(!is_null($request['image'])){ // 画像が更新された場合
                $file = $request['image'];
                $this->imageStock($file, true, $postData['id']);
            }
            // 画像が維持の場合は何もしない
        }else{ // 画像が元々ないまたは削除された場合
            if(!is_null($request['image'])){ // 画像が追加された場合
                $postData['image_flg'] = true;
                $file = $request['image'];
                $this->imageStock($file, true, $postData['id']);
            }else{ // 画像が削除された場合
                $postData['image_flg'] = false;
                $this->imageDelete($postData['id']);
            }
        }

        $this->blog->blogUpdate($postData);

        return redirect('/owner');
    }


    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'title'             => 'required|string|max:'.$this->title_length,
            'image'             => 'bail|file|max:3000|image|mimes:jpeg,png,jpg',
            'category'          => 'not_in:0',
            'origin_title'      => 'required|string|max:'.$this->title_length,
            'accepted_title'    => 'nullable|string|max:'.$this->title_length,
            'but_title'         => 'nullable|string|max:'.$this->title_length,
            'conclusion_title'  => 'nullable|string|max:'.$this->title_length,
            'origin_text'       => 'required|string|max:'.$this->text_length,
            'accepted_text'     => 'nullable|string|max:'.$this->text_length,
            'but_text'          => 'nullable|string|max:'.$this->text_length,
            'conclusion_text'   => 'nullable|string|max:'.$this->text_length,
        ]);
    }

    private function get_category()
    {
        return  $this->blog->set_category();
    }

    private function imageStock($file, $update_flg = false, $id = null)
    {
        if($update_flg){
            $insert_id = $id;
        }else{
            $max_id =  $this->blog->getBlogMaxId();
            $insert_id = isset($max_id) ? $max_id + 1 : 1;
        }
        $image_path = public_path($this->image_path.$insert_id);
        $file->move($image_path,$this->image_file);
    }

    // 画像のあるディレクトリを削除
    private function imageDelete($id)
    {
        Storage::deleteDirectory('public/blog/'.$id);
    }

    // ブログカセット取得
    private function getBlogList()
    {
        return $this->blog->setBlogCassette();
    }

    // ブログ詳細データ取得
    private function getBlogDetail($id)
    {
        return $this->blog->setBlogDetail($id);
    }
}