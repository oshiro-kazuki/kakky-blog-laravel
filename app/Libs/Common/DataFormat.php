<?php

namespace App\Libs\Common;

use DateTime;

class DataFormat
{
    // 年月日のみ抽出
    public function formatYmd(string $date_time)
    {
        if(!isset($date_time)) return;
        $date_time_format = new DateTime($date_time);
        $date = $date_time_format->format('Y-m-d');
        return $date;
    }

    // 文字列の切り出し
    public function formatLenthgCut($text, int $length) //$textはnullもある
    {
        if(!isset($text)) return;
        
        $content = $this->formatNewine($text);

        if (mb_strlen($content) > $length) {
            $content = mb_substr($content, 0, $length). '...';
        }
        return $content;
    }

    // 選択値をセット
    public function formatSelect(int $value, array $category_arr)
    {
        if(!isset($value) || !isset($category_arr)) return;
        $format = '';
        foreach($category_arr as $key => $num){
            if($value === $num){
                $format = $key;
            }
        }
        return $format;
    }

    // 改行・空白削除
    private function formatNewine(string $text)
    {
        if(!isset($text)) return;

        return str_replace(array("\r\n", "\r", "\n"), '', $text);
    }
}
?>