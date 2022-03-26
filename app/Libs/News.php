<?php

namespace App\Libs;

use App\Model\NewsList;

class News
{
    // ニュースデータを上限件数指定で取得
    public function getNewsListLimit(int $limit)
    {
        $news_lists = NewsList::orderBy('created_at', 'desc')
        ->limit($limit)
        ->get();
        return $news_lists;
    }
}
?>