<?php

namespace App\Libs;

use App\Model\Blogs;

class Blog
{
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