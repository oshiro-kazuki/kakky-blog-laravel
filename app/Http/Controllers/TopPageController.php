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
        $this->nophoto = config('const.NOPHOTO');
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
                $value->content = $df->formatLenthgCut($value->origin_text, $this->contet_length);
                $value->category = $df->formatSelect($value->category, $this->get_category());
                $value->image_path = $value->image_flg ? '/storage/blog/'. $value->id .'/blog_img.jpg' : $this->nophoto;
                $value->nice = $value->nice === 0 ? '-' : $value->nice;
            }
        }
        return $blog_lists;
    }

    // ブログカテゴリ取得
    private function get_category()
    {
        $blog = new Blog;
        return $blog->set_category();
    }
}
