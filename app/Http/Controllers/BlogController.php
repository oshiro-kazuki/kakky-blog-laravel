<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Blog;

class BlogController extends Controller
{    
    public function list()
    {
        $blog = $this->get_blog();

        return view('blog.list',
            [
                'blog_lists' => $blog['list'],
                'blog_css'   => $blog['css'],
            ]
        );
    }

    // ブログカセット取得
    private function get_blog()
    {
        $blog = new Blog();
        return $blog->setBlogCassette();
    }
}
