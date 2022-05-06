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

class BlogController extends Controller
{    
    public function __construct(Request $request)
    {
        $this->blog         = new Blog();
        $this->bn           = new BlogNice();
        $this->err          = new ErrorPage();
        $this->request      = $request;
        $this->host         = $this->request->server('HTTP_HOST');
        $this->uri          = $this->request->server('REQUEST_URI');
        $this->breadcrumb   = new Breadcrumb($this->uri);
    }

    // ブログ一覧画面表示
    public function list()
    {
        $blog = $this->blog->setBlogCassette();
        $title = 'ブログ一覧画面';
        $description = '全てのブログを一覧にしてます。是非、他の記事もご一読ください。';

        $breadcrumb = $this->breadcrumb->getBreadcrumb();

        return $this->showList($blog, $title, $description, $breadcrumb, true);
    }

    // ブログカテゴリ一覧画面表示
    public function categoryList($category)
    {
        $blog = $this->blog->setBlogCassette(false, $category);

        // カテゴリ名を取得
        $is_category = '';
        foreach($this->blog->setCategory() as $key => $value){
            if($value === $category){
                $is_category = $key;
            }
        }

        $title = 'ブログ・カテゴリ(' . $is_category . ')一覧画面';
        $description = 'カテゴリ(' . $is_category . ')で絞り込んだブログを一覧にしてます。是非、他の記事もご一読ください。';

        $this->breadcrumb->setSecondArr($this->blog->setCategory());
        $breadcrumb = $this->breadcrumb->getBreadcrumb();

        return $this->showList($blog, $title, $description, $breadcrumb, false);
    }

    private function showList(array $blog,string $title,string $description, $breadcrumb, $search_flg = false)
    {

        if(count($blog['list']) <= 0){
            return $this->err->nonePage();
        }

        foreach($blog['list'] as $key => $value){
            $value->nice = $this->bn->getCount($value->id); // いいね取得
        }

        $ogp = new OpenGraphProtocol($this->host, $this->uri, $title, $description);

        $category_list = '';
        if($search_flg){
            $category_list = $this->blog->getCategoryCount();
        }

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
        $blog = $this->blog->setBlogDetail($id);

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

        $owner = new Owner();
        $owner_data = $owner->getOwnerByOwnerIdToName($blog->owner_id)[0];

        $chat = array(
            'css'       => 'css/include/contents/chat.css',
            'js'        => 'js/include/contents/chat.js',
            'include'       => array(
                'owner_data'    => $owner_data,
                'length'        => array(
                    'name'      => $this->setChatIdNameLength(),
                    'email'     => $this->setChatEmailLength(),
                    'comment'   => $this->setChatCommentLength(),
                )
            )
        );

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
            ]
        );
    }

    // いいね更新
    public function nice_input()
    {
        $data = $this->request->all();
        $validator = $this->validatorNice();
        if($validator->fails()){
            return response()->json([
                'status' => 406,
            ]);
        }

        $bn = new BlogNice();
        $res = $bn->blogNiceInsert($data['id']);

        $status = $res ? 200 : 406;

        return response()->json([
            'status' => $status
        ]);
    }

    private function validatorNice()
    {
        return Validator::make($this->request->all(), [
            'id'    => 'required|string|max:' . $this->setChatIdNameLength(),
        ]);
    }

    private function setChatIdNameLength()
    {
        return config('const.TEXT_LENGTH20');
    }

    private function setChatEmailLength()
    {
        return config('const.TEXT_LENGTH191');
    }

    private function setChatCommentLength()
    {
        return config('const.TEXT_LENGTH140');
    }

    public function comment_input()
    {
        $data = $this->request->all();

        $validator = $this->validatorComment();
        if($validator->fails()){
            return response()->json([
                'status' => 406,
            ]);
        }

        $data['ip'] = $this->request->server('REMOTE_ADDR');

        $bC = new BlogComment();
        $res = $bC->blogCommentInsert($data);

        $status = $res ? 200 : 406;

        return response()->json([
            'status' => $status
        ]);
    }

    private function validatorComment()
    {
        return Validator::make($this->request->all(), [
            'id'        => 'required|string|max:' . $this->setChatIdNameLength(),
            'name'      => 'string|nullable|max:' . $this->setChatIdNameLength(),
            'email'     => 'string|nullable|email|max:' . $this->setChatEmailLength(),
            'comment'   => 'required|string|max:' . $this->setChatCommentLength(),
        ]);
    }
}