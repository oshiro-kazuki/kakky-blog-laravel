<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\News;

class NewsController extends Controller
{    
    public function index()
    {
        $news = new News();
        $news_lists = $news->getNewsListLimit(10);

        if(count($news_lists) > 0){
            foreach ($news_lists as $key => $value) {
                $value->created_at_date = $news->formatDate($value->created_at);
            }
        }

        return view('news.index', ['news_lists' => $news_lists]);
    }
}
