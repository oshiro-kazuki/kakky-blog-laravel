<?php

namespace App\Libs;

use App\Model\Blogs;

class Blog
{
    // ブログid最大値習得
    public function getBlogMaxId()
    {
        return Blogs::max('id');
    }

    // ブログ挿入処理
    public function blogInsert(array $postData){
        Blogs::insertGetId(
            [
                'created_at'        => date('Y-m-d H:i:s'),
                'title'             => $postData['title'],
                'image_flg'         => $postData['image_flg'],
                'category'          => $postData['category'],
                'origin_title'      => $postData['origin_title'],
                'origin_text'       => $postData['origin_text'],
                'accepted_title'    => $postData['accepted_title'],
                'accepted_text'     => $postData['accepted_text'],
                'but_title'         => $postData['but_title'],
                'but_text'          => $postData['but_text'],
                'conclusion_title'  => $postData['conclusion_title'],
                'conclusion_text'   => $postData['conclusion_text'],
            ]
        );
    }

    // ブログデータを上限件数指定で取得
    public function getBlogListLimit(int $limit)
    {
        $blog_lists = Blogs::orderBy('created_at', 'desc')
        ->limit($limit)
        ->get();

        return $blog_lists;
    }

    // カテゴリーセット
    public function set_category()
    {
        $count = 0;
        return array(
            '選択'  => $count,
            '日常'  => ++$count,
            'コード' => ++$count,
            '観光'  => ++$count,
        );
    }
}
?>