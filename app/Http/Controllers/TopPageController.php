<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\News;

class TopPageController extends Controller
{
    public function index()
    {
        $news_lists = $this->get_news();

        return view('index', ['news_lists' => $news_lists]);
    }

    // ニュース情報取得
    private function get_news()
    {
        $news = new News();
        $news_lists = $news->getNewsListLimit(5);

        if(count($news_lists) > 0){
            foreach ($news_lists as $key => $value) {
                $value->created_at_date = $news->formatDate($value->created_at);
                $value->content_format = $news->contentLenthgCut($value->content);
            }
        }
        
        return $news_lists;
    }
}
