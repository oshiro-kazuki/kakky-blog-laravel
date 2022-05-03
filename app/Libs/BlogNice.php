<?php

namespace App\Libs;

use Illuminate\Database\QueryException;
use App\Model\BlogNices;

class BlogNice
{
    // いいねカウント取得
    public function getCount($blog_id)
    {
        $count = BlogNices::where('blog_id', $blog_id)
        ->count();

        return $this->setNice($count);
    }

    // いいねが0なら-をセット
    private function setNice($nice)
    {
        return $nice === 0 ? '-' : $nice;
    }

    // いいね挿入処理
    public function blogNiceInsert(string $blog_id){
        try{
            BlogNices::insertGetId(
                array(
                    'created_at'    => date('Y-m-d H:i:s'),
                    'blog_id'       => $blog_id
                )
            );
            return true;
        }catch(QueryException $e) {
            return false;
        }
    }
}
?>