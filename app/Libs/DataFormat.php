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

    // 文字列の切り出し
    public function formatLenthgCut(string $text, int $length)
    {
        $content = $text;
        if (mb_strlen($text) > $length) {
            $content = mb_substr($text, 0, $length). '...';
        }
        return $content;
    }

    // 選択値をセット
    public function formatSelect(int $value, array $category_arr)
    {
        $format = '';
        foreach($category_arr as $key => $num){
            if($value === $num){
                $format = $key;
            }
        }
        return $format;
    }
}
?>