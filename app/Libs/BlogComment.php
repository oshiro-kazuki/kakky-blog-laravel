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

    // blog_idでコメント取得
    public function getBlogCommentByBlogId(string $blog_id)
    {
        return BlogComments::where('blog_id', $blog_id)
        ->select('user_type', 'comment_id', 'name', 'comment')
        ->get();
    }
}
?>