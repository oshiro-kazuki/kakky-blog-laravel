<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Common\OpenGraphProtocol;
use App\Libs\Common\ErrorPage;
use App\Libs\Blog;

class BlogController extends Controller
{    
    public function __construct(Request $request)
    {
        $this->blog     = new Blog();
        $this->err      = new ErrorPage();
        $this->request  = $request;
        $this->host     = $this->request->server('HTTP_HOST');
        $this->uri      = $this->request->server('REQUEST_URI');
    }

    // ブログ一覧画面表示
    public function list()
    {
        $blog = $this->blog->setBlogCassette();
        $title = 'ブログ一覧画面';
        $description = 'カテゴリ問わずブログを一覧にしてます。是非、他の記事もご一読ください。';
        $ogp = new OpenGraphProtocol($this->host, $this->uri, $title, $description);

        if(count($blog['list']) <= 0){
            return $this->err->nonePage();
        }

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
    public function detail($id)
    {
        $blog = $this->blog->setBlogDetail($id);

        if(!isset($blog)){
            return $this->err->nonePage();
        }

        $ogp = new OpenGraphProtocol($this->host, $this->uri, $blog->title, $blog->description);

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

    // ブログカテゴリ一覧画面表示
    public function categoryList()
    {
        $category = substr($this->request->path(),10);
        $blog = $this->blog->setBlogCassette(false, $category);

        // カテゴリ名を取得
        $is_category = '';
        foreach($this->blog->setCategory() as $key => $value){
            if($value === $category){
                $is_category = $key;
            }
        }

        $title = 'ブログ・カテゴリ(' . $is_category . ')一覧画面';
        $description = 'カテゴリ(' . $is_category . ')で絞り込んだブログを一覧にしてます。是非、他の記事もご一読ください。';
        $ogp = new OpenGraphProtocol($this->host, $this->uri, $title, $description);

        if(count($blog['list']) <= 0){
            return $this->err->nonePage();
        }

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
}