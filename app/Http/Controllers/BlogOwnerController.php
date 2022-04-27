<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Libs\Common\ErrorPage;
use App\Libs\Blog;

class BlogOwnerController extends Controller
{
    private $upload_path = 'public/blog/';

    public function __construct()
    {
        $this->middleware('auth:owner');
        $this->blog = new Blog();
    }

    // ブログ投稿画面表示
    public function showinput()
    {
        $style = [
            '/css/owner/blog_input.css',
        ];
        $script = [
            'js/owner/blog_input.js',
        ];

        header('X-Frame-Options: DENY');

        return view('.owner.blog.blog_input',
        [
            'screen_title'      => 'ブログ投稿画面',
            'category_list'     => $this->getCategory(),
            'style'             => $style,
            'script'            => $script,
            'title_length'      => $this->getTitleLength(),
            'text_length'       => $this->getTextLength(),
            'reference_length'  => $this->getReferenceLength(),
        ]);
    }

    // ブログ投稿処理
    public function blogPost(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect('/owner/blog/blog_input')->withErrors($validator)->withInput();
        }

        $postData = $request->all();
        
        $postData['image_flg'] = false;

        if(!is_null($request['image'])){ //データがあれば保存処理
            $postData['image_flg'] = true;
            $file = $request['image'];
            $this->imageStock($file);
        }

        $this->blog->blogInsert($postData);

        return redirect('/owner');
    }

    // ブログ一覧画面表示
    public function showList()
    {
        $blog_data = $this->getBlogList();

        return view('.owner.blog.blog_list',
            [
                'screen_title' => 'ブログ一覧(管理)',
                'blog_lists'   => $blog_data['list'],
                'blog_css'     => $blog_data['css'],
                'owner_flg'    => true,
            ]
        );
    }

    // ブログ編集画面表示
    public function showEdit($id)
    {
        $blog_data = $this->getBlogDetail($id);

        if(!isset($blog_data)){
            $err = new ErrorPage;
            return $err->nonePage();
        }

        $style = [
            '/css/owner/blog_input.css',
        ];
        $script = [
            'js/owner/blog_input.js',
        ];

        header('X-Frame-Options: DENY');
        
        return view('.owner.blog.blog_edit',
        [
            'screen_title'      => 'ブログ編集画面',
            'blog_data'         => $blog_data,
            'category_list'     => $this->getCategory(),
            'style'             => $style,
            'script'            => $script,
            'title_length'      => $this->getTitleLength(),
            'text_length'       => $this->getTextLength(),
            'reference_length'  => $this->getReferenceLength(),
        ]);
    }

    // ブログ更新処理
    public function blogEdit(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect('/owner/blog/blog_edit/'.$request->id)->withErrors($validator)->withInput();
        }

        $postData = $request->all();

        if($postData['image_flg'] === '1'){ // 画像が更新または維持された場合
            $postData['image_flg'] = true;
            if(!is_null($request['image'])){ // 画像が更新された場合
                $file = $request['image'];
                $this->imageStock($file, true, $postData['id']);
            }
            // 画像が維持の場合は何もしない
        }else{ // 画像が元々ないまたは削除された場合
            if(!is_null($request['image'])){ // 画像が追加された場合
                $postData['image_flg'] = true;
                $file = $request['image'];
                $this->imageStock($file, true, $postData['id']);
            }else{ // 画像が削除された場合
                $postData['image_flg'] = false;
                $this->imageDelete($postData['id']);
            }
        }

        $this->blog->blogUpdate($postData);

        return redirect('/owner');
    }

    // ブログ用バリデーション
    private function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'title'             => 'required|string|max:'.$this->getTitleLength(),
            'image'             => 'bail|file|max:3000|image|mimes:jpeg,png,jpg',
            'category'          => 'not_in:' . $this->getCategory()['選択'],
            'origin_title'      => 'required|string|max:'.$this->getTitleLength(),
            'accepted_title'    => 'nullable|string|max:'.$this->getTitleLength(),
            'but_title'         => 'nullable|string|max:'.$this->getTitleLength(),
            'conclusion_title'  => 'nullable|string|max:'.$this->getTitleLength(),
            'origin_text'       => 'required|string|max:'.$this->getTextLength(),
            'accepted_text'     => 'nullable|string|max:'.$this->getTextLength(),
            'but_text'          => 'nullable|string|max:'.$this->getTextLength(),
            'conclusion_text'   => 'nullable|string|max:'.$this->getTextLength(),
            'reference_text1'   => 'nullable|string|max:'.$this->getTitleLength(),
            'reference_link1'   => 'nullable|string|max:'.$this->getReferenceLength(),
            'reference_text2'   => 'nullable|string|max:'.$this->getTitleLength(),
            'reference_link2'   => 'nullable|string|max:'.$this->getReferenceLength(),
        ]);
    }

    // タイトル最大文字数
    private function getTitleLength()
    {
        return config('const.TEXT_LENGTH35');
    }

    // テキスト最大文字数
    private function getTextLength()
    {
        return config('const.TEXT_LENGTH1000');
    }

    // 参考リンク最大文字数
    private function getReferenceLength()
    {
        return config('const.TEXT_LENGTH140');
    }

    // 画像ファイル名
    private function getFilename()
    {
        return $this->blog->setFilename();
    }

    // カテゴリ
    private function getCategory()
    {
        return $this->blog->setCategory();
    }

    // 画像アップロード処理
    private function imageStock($file, $update_flg = false, $id = null)
    {
        if($update_flg){
            $insert_id = $id;
        }else{
            $max_id = $this->blog->getBlogMaxId();
            $insert_id = isset($max_id) ? $max_id + 1 : 1;
        }
        // ディレクトリ / ファイル / ファイル名で保存 
        Storage::putFileAs($this->upload_path.$insert_id, $file, $this->getFilename());
    }

    // 画像削除削除
    private function imageDelete($id)
    {
        Storage::deleteDirectory($this->upload_path.$id);
    }

    // ブログカセット取得
    private function getBlogList()
    {
        return $this->blog->setBlogCassette();
    }

    // ブログ詳細データ取得
    private function getBlogDetail($id)
    {
        return $this->blog->setBlogDetail($id);
    }
}