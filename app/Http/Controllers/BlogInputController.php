<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libs\Blog;

class BlogInputController extends Controller
{
    public function __construct()
    {
        $this->title_length      = config('const.TEXT_LENGTH20');
        $this->text_length       = config('const.TEXT_LENGTH1000');
        $this->image_upload_path = config('const.BLOG_IMAGE_PATH');
        $this->middleware('auth:owner');
    }
    
    public function index()
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

        $blog = new Blog();
        $blog->blogInsert($postData);

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
        $blog = new Blog;
        return $blog->set_category();
    }

    private function imageStock($file)
    {
        $blog = new Blog();
        $max_id = $blog->getBlogMaxId();
        $insert_id = isset($max_id) ? $max_id + 1 : 1;
        $image_path = public_path($this->image_upload_path.$insert_id);
        $file_name = 'blog_img.jpg';
        $file->move($image_path,$file_name);
    }
}