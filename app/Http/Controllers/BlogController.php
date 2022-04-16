<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Common\OpenGraphProtocol;
use App\Libs\Blog;
use App\Libs\ErrorPage;

class BlogController extends Controller
{    
    public function __construct()
    {
        $this->blog = new Blog();
    }

    // ブログ一覧画面表示
    public function list(Request $request)
    {
        $blog = $this->blog->setBlogCassette();
        $title = 'ブログ一覧画面';
        $description = 'カテゴリ問わずブログを一覧にしてます。是非、他の記事もご一読ください。';
        $ogp = new OpenGraphProtocol($request->server('HTTP_HOST'), $request->server('REQUEST_URI'), $title, $description);

        return view('blog.list',
            [
                'blog_lists'    => $blog['list'],
                'blog_css'      => $blog['css'],
                'title'         => $title,
                'description'   => $description,
                'ogp'           => $ogp,
            ]
        );
    }

    // ブログ詳細画面表示
    public function detail($id, Request $request)
    {
        $blog = $this->blog->setBlogDetail($id);

        if(!isset($blog)){
            $err = new ErrorPage;
            return $err->nonePage();
        }

        $ogp = new OpenGraphProtocol($request->server('HTTP_HOST'), $request->server('REQUEST_URI'), $blog->title, $blog->description);

        return view('blog.detail',
            [
                'blog_data'     => $blog,
                'blog_css'      => 'css/blog/detail.css',
                'breadcrumb'    => 'css/common/breadcrumb.css',
                'title'         => $blog->title,
                'description'   => $blog->description,
                'ogp'           => $ogp,
            ]
        );
    }
}