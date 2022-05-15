<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Common\DataFormat;
use App\Libs\Common\OpenGraphProtocol;
use App\Libs\News;
use App\Libs\Blog;
use App\Libs\BlogNice;

class TopPageController extends Controller
{
    public function __construct()
    {
        $this->news_contet_length = config('const.TEXT_LENGTH35');
    }

    public function index(Request $request)
    {
        $news_lists = $this->get_news();
        $blog = $this->get_blog();
        $title = config('const.APP_NAME');
        $description = '沖縄、観光施設、プログラミング、本の紹介など、調べたり経験した内容をアウトプットするブログです。';
        $ogp = new OpenGraphProtocol($request->server('HTTP_HOST'), $request->server('REQUEST_URI'), $title, $description);
        
        return view(
            'index', 
            [
                'news_lists'    => $news_lists,
                'blog_lists'    => $blog['list'],
                'blog_css'      => $blog['css'],
                'title'         => $title,
                'description'   => $description,
                'ogp'           => $ogp,
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

    // ブログカセット取得
    private function get_blog()
    {
        $blog = new Blog();
        $bn   = new BlogNice();

        $blog_data = $blog->setBlogCassette(9);

        foreach($blog_data['list'] as $key => $value){
            $value->nice = $bn->getCount($value->id); // いいね取得
        }

        return $blog_data;
    }
}
