<?php

namespace App\Libs;

use DateTime;

class DataFormat
{
    // 年月日のみ抽出
    public function formatYmd(string $date_time)
    {
        $date_time_format = new DateTime($date_time);
        $date = $date_time_format->format('Y-m-d');
        return $date;
    }

    // 内容を指定した文字列に切り出し
    public function formatLenthgCut(string $text, int $length)
    {
        $content = $text;
        if (mb_strlen($text) > $length) {
            $content = mb_substr($text, 0, $length). '...';
        }
        return $content;
    }
}
?>