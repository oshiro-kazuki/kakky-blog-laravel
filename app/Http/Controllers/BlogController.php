<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libs\Common\OpenGraphProtocol;
use App\Libs\Common\ErrorPage;
use App\Libs\Common\Breadcrumb;
use App\Libs\Blog;
use App\Libs\BlogNice;
use App\Libs\Owner;
use App\Libs\BlogComment;
use App\Libs\Mail\BlogCommentMailSend;
use App\Libs\Mail\Owner\BlogCommentOwnerMailSend;
use Mail;
use stdClass;

class BlogController extends Controller
{    
    public function __construct(Request $request)
    {
        $this->blog         = new Blog();
        $this->bn           = new BlogNice();
        $this->bc           = new BlogComment();
        $this->err          = new ErrorPage();
        $this->request      = $request;
        $this->host         = $this->request->server('HTTP_HOST');
        $this->uri          = $this->request->server('REQUEST_URI');
        $this->breadcrumb   = new Breadcrumb($this->uri);
    }

    // ブログ一覧画面表示
    public function list()
    {
        // ブログカセットデータ取得
        $blog = $this->blog->setBlogCassette();

        // 画面タイトル・説明設定
        $title = 'ブログ一覧画面';
        $description = '全てのブログを一覧にしてます。是非、他の記事もご一読ください。';

        // パンくず取得
        $breadcrumb = $this->breadcrumb->getBreadcrumb();

        // 画面表示用の関数に渡す
        return $this->showList($blog, $title, $description, $breadcrumb, true);
    }

    // ブログカテゴリ一覧画面表示
    public function categoryList($category)
    {
        // ブログカセットデータ取得
        $blog = $this->blog->setBlogCassette(false, $category);

        // カテゴリ名を取得
        $is_category = '';
        foreach($this->blog->setCategory() as $key => $value){
            if($value === $category){
                $is_category = $key;
            }
        }

        // 画面タイトル・説明設定
        $title = 'ブログ・カテゴリ(' . $is_category . ')一覧画面';
        $description = 'カテゴリ(' . $is_category . ')で絞り込んだブログを一覧にしてます。是非、他の記事もご一読ください。';

        // パンくず取得
        $this->breadcrumb->setSecondArr($this->blog->setCategory());
        $breadcrumb = $this->breadcrumb->getBreadcrumb();

        // 画面表示用の関数に渡す
        return $this->showList($blog, $title, $description, $breadcrumb, false);
    }

    // 一覧・カテゴリ一覧画面表示関数
    private function showList(array $blog,string $title,string $description, $breadcrumb, $search_flg = false)
    {

        // ブログデータが無ければエラー画面を表示
        if(count($blog['list']) <= 0){
            return $this->err->nonePage();
        }

        foreach($blog['list'] as $key => $value){
            $value->nice = $this->bn->getCount($value->id); // いいね取得
        }

        // Open Graph Protocolデータを取得
        $ogp = new OpenGraphProtocol($this->host, $this->uri, $title, $description);

        $category_list = '';
        if($search_flg){
            $category_list = $this->blog->getCategoryCount(); // カテゴリ毎に件数を取得
        }

        // 画面表示
        return view('blog.list',
            [
                'blog_lists'    => $blog['list'],
                'blog_css'      => $blog['css'],
                'title'         => $title,
                'description'   => $description,
                'ogp'           => $ogp,
                'breadcrumb'    => $breadcrumb,
                'search_flg'    => $search_flg,
                'category_list' => $category_list,
            ]
        );
    }

    // ブログ詳細画面表示
    public function detail($category, $id)
    {
        // ブログ詳細データ取得
        $blog = $this->blog->setBlogDetail($id);

        // ブログデータが無ければエラー画面を表示
        if(!isset($blog)){
            return $this->err->nonePage();
        }

        $blog->nice = $this->bn->getCount($id); // いいね取得

        $ogp = new OpenGraphProtocol($this->host, $this->uri, $blog->title, $blog->description);

        $this->breadcrumb->setSecondArr($this->blog->setCategory());
        $this->breadcrumb->setLastArr([$blog->title => $id]);
        $breadcrumb = $this->breadcrumb->getBreadcrumb();

        $detail_js = array(
            'js/blog/nice.js',
        );

        // ブログのオーナーデータ取得
        $owner      = new Owner();
        $owner_data = $owner->getOwnerByOwnerIdToName($blog->owner_id);

        // チャットコンテンツ用
        $chat = array(
            'css'           => 'css/include/contents/chat.css',
            'js'            => 'js/include/contents/chat.js',
            'include'       => array(
                'owner_data'    => $owner_data,
                'length'        => array(
                    'name'      => $this->bc->setIdNameLength(),
                    'email'     => $this->bc->setEmailLength(),
                    'comment'   => $this->bc->setCommentLength(),
                )
            )
        );
        
        // ブログコメントデータ取得
        $blog_comment        = new stdClass;
        $blog_comment->user  = $this->bc->getBlogUserCommentByBlogId($id);  // ブログユーザーコメント全件取得
        $blog_comment->owner = $this->bc->getBlogOwnerCommentByBlogId($id); // ブログブロガーコメント全件取得
        
        // 画面表示
        return view('blog.detail',
            [
                'blog_data'     => $blog,
                'blog_css'      => 'css/blog/detail.css',
                'title'         => $blog->title,
                'description'   => $blog->description,
                'ogp'           => $ogp,
                'breadcrumb'    => $breadcrumb,
                'detail_js'     => $detail_js,
                'id'            => $id,
                'chat'          => $chat,
                'blog_comment'  => $blog_comment,
            ]
        );
    }

    // いいね挿入処理
    public function nice_input()
    {
        $data = $this->request->all(); // 入力データ取得

        $validator = $this->validatorNice(); // バリデーション
        if($validator->fails()){
            return response()->json([
                'status' => 406,
            ]);
        }

        $res = $this->bn->blogNiceInsert($data['id']); // いいね挿入

        $status = $res ? 200 : 406; // 成功なら200

        return response()->json([
            'status' => $status
        ]);
    }

    // いいねバリデーション
    private function validatorNice()
    {
        return Validator::make($this->request->all(), [
            'id'    => 'required|string|max:' . $this->bn->setBlogIdLength(),
        ]);
    }

    // コメント挿入処理
    public function comment_input()
    {
        $data = $this->request->all(); // 入力データ取得

        $validator = $this->validatorComment(); // バリデーション
        if($validator->fails()){
            return response()->json([
                'status' => 406,
            ]);
        }
        
        $data['ip'] = $this->request->server('REMOTE_ADDR'); // ユーザーのip取得

        $res = $this->bc->blogCommentUserInsert($data);      // コメント挿入処理

        // owner_id取得
        $blog_data = $this->blog->getOwnerIdByBlogId($data['id']);
        $owenr_id = $blog_data->owner_id;

        // ブログのオーナーデータ取得
        $owner      = new Owner();
        $owner_data = $owner->getOwnerByOwnerIdToEmail($owenr_id);
        
        // メール送信処理 ※ブログURL・コメント必須
        if(!is_null($data['email'])){
            Mail::to($data['email'])->send(             // ユーザーへメール送信
                new BlogCommentMailSend($data['url'], $data['comment'])
            );
        }
        Mail::to($owner_data->email)->send(             // ブロガーへメール送信
            new BlogCommentOwnerMailSend($data['url'], $data['comment'], $data['name'])
        );

        $status = $res ? 200 : 406; // 成功なら200

        return response()->json([
            'status' => $status
        ]);
    }

    // コメントバリデーション
    private function validatorComment()
    {
        return Validator::make($this->request->all(), [
            'id'        => 'required|string|max:' . $this->bc->setIdNameLength(),
            'name'      => 'string|nullable|max:' . $this->bc->setIdNameLength(),
            'email'     => 'string|nullable|email|max:' . $this->bc->setEmailLength(),
            'comment'   => 'required|string|max:' . $this->bc->setCommentLength(),
        ]);
    }
}