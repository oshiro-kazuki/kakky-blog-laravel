<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Blog;

class BlogController extends Controller
{    
    // ブログ一覧画面表示
    public function list()
    {
        $blog = $this->getBlogList();

        return view('blog.list',
            [
                'blog_lists' => $blog['list'],
                'blog_css'   => $blog['css'],
            ]
        );
    }

    // ブログ詳細画面表示
    public function detail($id)
    {
        $blog = $this->getBlogDetail($id);

        if(!isset($blog)){
            return view('error.none_page');
        }

        return view('blog.detail',
            [
                'blog_data'  => $blog,
                'blog_css'   => 'css/blog/detail.css',
                'breadcrumb' => 'css/common/breadcrumb.css',
            ]
        );
    }

    // ブログカセット取得
    private function getBlogList()
    {
        $blog = new Blog();
        return $blog->setBlogCassette();
    }

    // ブログ詳細データ取得
    private function getBlogDetail($id)
    {
        $blog = new Blog();
        return $blog->setBlogDetail($id);
    }
}