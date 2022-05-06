<?php

namespace App\Libs;

use Illuminate\Database\QueryException;
use App\Model\BlogComments;

class BlogComment
{
    // コメント挿入処理
    public function blogCommentInsert($data){
        try{
            BlogComments::insertGetId(
                array(
                    'created_at'    => date('Y-m-d H:i:s'),
                    'blog_id'       => $data['id'],
                    'ip'            => $data['ip'],
                    'name'          => $data['name'],
                    'email'         => $data['email'],
                    'comment'       => $data['comment'],
                )
            );
            return true;
        }catch(QueryException $e) {
            return false;
        }
    }

    // コメント取得
    public function getBlogComment(string $blog_id)
    {
        $data = BlogComments::where('blog_id', $blog_id)
        ->select('user_type', 'comment_id', 'name', 'comment')
        ->get();

        foreach($data as $value){
            if($value['name'] === null) $value['name'] = $this->setNoName($value['name']);
        }

        return $data;
    }

    // 匿名セット
    private function setNoName($name)
    {
        if($name !== null) return;

        return '匿名';
    }
}
?>