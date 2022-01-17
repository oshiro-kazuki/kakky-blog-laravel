<?php

namespace App\Libs;

use DateTime;
use App\NewsList;

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

    // 年月日のみ抽出
    public function formatDate(string $date_time)
    {
        $date_time_format = new DateTime($date_time);
        $date = $date_time_format->format('Y-m-d');
        return $date;
    }

    // 内容を指定した文字列に切り出し
    public function contentLenthgCut(string $content_text)
    {
        $const_length = config('const.CONTENT_LENGTH_TEMPLATE');
        $content = $content_text;
        if (mb_strlen($content_text) > $const_length) {
            $content = mb_substr($content_text, 0, $const_length). '...';
        }
        return $content;
    }
}
?>