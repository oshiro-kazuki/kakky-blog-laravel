<?php

namespace App\Libs;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Model\BlogComments;

class BlogComment
{
    // コメント挿入処理
    public function blogCommentUserInsert($data){
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
        ->select('del_flg', 'id', 'comment_id', 'user_type', 'name', 'comment')
        ->get();
    }

    // blog_idでコメント全件取得
    public function getBlogCommentAllByBlogId(object $blog_id)
    {
        return BlogComments::orderBy('created_at', 'desc')
        ->select('id', 'del_flg', 'view_flg', 'comment_id', 'user_type', 'name', 'comment')
        ->whereIn('blog_id', $blog_id)
        ->get();
    }

    // idでコメント取得
    public function getBlogCommentById(string $id)
    {
        return BlogComments::find($id);
    }

    // blog_idと名前の長さ指定
    public function setIdNameLength()
    {
        return config('const.TEXT_LENGTH20');
    }

    // メールアドレスの長さ指定
    public function setEmailLength()
    {
        return config('const.TEXT_LENGTH191');
    }

    // コメントの長さ指定
    public function setCommentLength()
    {
        return config('const.TEXT_LENGTH140');
    }

    // コメント挿入処理
    public function blogCommentOwnerInsert($data){
        try{
            DB::beginTransaction();

            // ブロガー返答処理
            BlogComments::insertGetId(
                array(
                    'created_at'    => date('Y-m-d H:i:s'),
                    'blog_id'       => $data['blog_id'],
                    'user_type'     => 1,                   // ブロガー
                    'view_flg'      => 1,                   // 返答は既読
                    'comment_id'    => $data['id'],
                    'name'          => $data['owner_nm'],
                    'comment'       => $data['comment'],
                )
            );

            // ユーザーコメント既読更新処理
            BlogComments::where('id', $data['id'])
                ->update(
                    array(
                        'updated_at'    => date('Y-m-d H:i:s'),
                        'view_flg'      => 1,                   // 返答は既読
                    )
            );

            DB::commit();

            return true;
        }catch(QueryException $e) {
            DB::rollBack();
            
            return false;
        }
    }

    // コメントdel_flg更新処理
    public function blogCommentDel(array $postData){
        // dd(gettype($postData));
        try{
            BlogComments::where('id', $postData['id'])
            ->update(
                array(
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'del_flg'       => $postData['del_flg'],
                )
            );
            return true;
        }catch(QueryException $e) {
            return false;
        }
    }
}
?>