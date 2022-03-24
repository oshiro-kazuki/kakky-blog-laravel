<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\DataFormat;
use App\Libs\News;
use App\Libs\Blog;

class TopPageController extends Controller
{
    public function __construct()
    {
        $this->news_contet_length = config('const.TEXT_LENGTH35');
        $this->contet_length = config('const.TEXT_LENGTH140');
    }

    public function index()
    {
        $news_lists = $this->get_news();
        $blog_lists = $this-> get_blog();

        return view(
            'index', 
            [
                'news_lists' => $news_lists,
                'blog_lists' => $blog_lists,
            ]
        );
    }

    // ニュース情報取得
    private function get_news()
    {
        $news = new News();
        $news_lists = $news->getNewsListLimit(5);

        if(count($news_lists) > 0){
            $df = new DataFormat();

            foreach ($news_lists as $key => $value) {
                $value->created_at_date = $df->formatYmd($value->created_at);
                $value->content_format = $df->formatLenthgCut($value->content, $this->news_contet_length);
            }
        }
        
        return $news_lists;
    }

    // ブログ情報取得
    private function get_blog()
    {
        $blog = new Blog();
        $blog_lists = $blog->getBlogListLimit(10);

        if(count($blog_lists) > 0){
            $df = new DataFormat();

            foreach ($blog_lists as $key => $value) {
                $value->created_at_date = $df->formatYmd($value->created_at);
                $value->content_format = $df->formatLenthgCut($value->origin_text, $this->contet_length);
            }
        }
        
        return $blog_lists;
    }
}
