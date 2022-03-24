<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Blogs;
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
            '/css/blog/blog_input.css',
        ];
        $script = [
            'js/owner/blog_input.js',
        ];
        return view('.owner.blog_input',
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
            return redirect('/owner/blog_input')->withErrors($validator)->withInput();
        }

        $image_flg = false;

        $postData = $request->all();

        if(!is_null($request['image'])){
            $image_flg = true;
            $file = $request['image'];
            $this->imageStock($file);
        }

        Blogs::insertGetId(
            [
                'created_at'        => date('Y-m-d H:i:s'),
                'title'             => $postData['title'],
                'image_flg'         => $image_flg,
                'category'          => $postData['category'],
                'origin_title'      => $postData['origin_title'],
                'origin_text'       => $postData['origin_text'],
                'accepted_title'    => $postData['accepted_title'],
                'accepted_text'     => $postData['accepted_text'],
                'but_title'         => $postData['but_title'],
                'but_text'          => $postData['but_text'],
                'conclusion_title'  => $postData['conclusion_title'],
                'conclusion_text'   => $postData['conclusion_text'],
            ]
        );
        return redirect('/owner');
    }

    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'title'             => 'required|string|max:'.$this->title_length,
            'image'             => 'bail|file|max:3000|image|mimes:jpeg,png,jpg',
            'category'          => 'not_in:0',
            'origin_title'      => 'required|string|max:'.$this->title_length,
            'accepted_title'    => 'required|string|max:'.$this->title_length,
            'but_title'         => 'required|string|max:'.$this->title_length,
            'conclusion_title'  => 'required|string|max:'.$this->title_length,
            'origin_text'       => 'required|string|max:'.$this->text_length,
            'accepted_text'     => 'required|string|max:'.$this->text_length,
            'but_text'          => 'required|string|max:'.$this->text_length,
            'conclusion_text'   => 'required|string|max:'.$this->text_length,
        ]);
    }

    private function get_category()
    {
        $blog = new Blog;
        return $blog->set_category();
    }

    private function imageStock($file)
    {
        $max_id = Blogs::max('id');
        $insert_id = isset($max_id) ? $max_id + 1 : 1;
        $image_path = public_path($this->image_upload_path.$insert_id);
        $file_name = 'blog_img.jpg';
        $file->move($image_path,$file_name);
    }
}