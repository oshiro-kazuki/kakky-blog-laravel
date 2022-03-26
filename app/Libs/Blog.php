<?php

namespace App\Libs;

use App\Model\Blogs;
use App\Libs\DataFormat;

class Blog
{
    public function __construct()
    {
        $this->content_length = config('const.TEXT_LENGTH90');
        $this->nophoto = config('const.NOPHOTO');
    }

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
    public function getBlogList()
    {
        $blog_lists = Blogs::orderBy('created_at', 'desc')
        ->get();

        return $blog_lists;
    }
     
    // ブログデータを上限件数指定で取得
    public function getBlogListLimit(int $limit)
    {
        $blog_lists = Blogs::orderBy('created_at', 'desc')
        ->limit($limit)
        ->get();

        return $blog_lists;
    }

    public function getIdBlog(string $id)
    {
        return Blogs::find($id);
    }

    // 画像パス取得
    private function setImagePath(bool $flg, $id)
    {
        return $flg ? '/storage/blog/'. $id .'/blog_img.jpg' : $this->nophoto;
    }

    // いいね取得
    private function setNice($nice)
    {
        return $nice === 0 ? '-' : $nice;
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

    // include用カセット
    public function setBlogCassette($limit = false)
    {
        // limitの指定がなければ全件取得
        $list = $limit ? $this->getBlogListLimit($limit) : $this->getBlogList($limit);

        // ブログ情報を整形
        if(count($list) > 0){
            $df = new DataFormat();
            foreach ($list as $key => $value) {
                $value->created_at_date = $df->formatYmd($value->created_at);
                $value->content = $df->formatLenthgCut($value->origin_text, $this->content_length);
                $value->category = $df->formatSelect($value->category, $this->set_category());
                $value->image_path = $this->setImagePath($value->image_flg, $value->id);
                $value->nice = $this->setNice($value->nice);
            }
        }

        // cssを指定
        $blog = array(
            'css'  => 'css/include/contents/blog.css',
            'list' => $list,
        );

        return $blog;
    }

    // 詳細データ取得
    public function setBlogDetail(string $id)
    {
        $data = $this->getIdBlog($id);

        // ブログ情報を整形
        if(isset($data)){
            $df = new DataFormat();

            $data->date = $df->formatYmd($data->created_at);
            $data->category = $df->formatSelect($data->category, $this->set_category());
            $data->image_path = $this->setImagePath($data->image_flg, $data->id);
            $data->nice = $this->setNice($data->nice);
        }

        // cssを指定
        $blog = array(
            'css'  => 'css/blog/detail.css',
            'data' => $data,
        );

        return $blog;
    }
}
?>