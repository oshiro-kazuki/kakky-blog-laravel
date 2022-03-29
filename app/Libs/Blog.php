<?php

namespace App\Libs;

use App\Model\Blogs;
use App\Libs\DataFormat;

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
            $this->blogColumn($postData, true)
        );
    }

     // ブログ編集処理
    public function blogUpdate(array $postData)
    {
        Blogs::where('id', $postData['id'])
        ->update(
            $this->blogColumn($postData, false)
        );
    }

    // ブログ用カラム切り替え制御
    private function blogColumn(array $postData, bool $insert_flg)
    {
        $is_at = $insert_flg ? 'created_at' : 'updated_at';
        return array(
                $is_at              => date('Y-m-d H:i:s'),
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
        );
    }

    // ブログデータを全件・降順で取得
    public function getBlogList()
    {
        $blog_lists = Blogs::orderBy('created_at', 'desc')
        ->get();

        return $blog_lists;
    }
     
    // ブログデータを上限件数指定・降順で取得
    public function getBlogListLimit(int $limit)
    {
        $blog_lists = Blogs::orderBy('created_at', 'desc')
        ->limit($limit)
        ->get();

        return $blog_lists;
    }

    // idからブログデータ取得
    public function getIdBlog(string $id)
    {
        return Blogs::find($id);
    }

    // 表示用画像パス設定
    private function setImagePath(bool $flg, $id)
    {
        return $flg ? '/storage/blog/' . $id .'/'. $this->setFilename() : config('const.NOPHOTO');
    }

    // いいねが0なら-をセット
    private function setNice($nice)
    {
        return $nice === 0 ? '-' : $nice;
    }

    // 画像名セット
    public function setFilename()
    {
        return 'blog_img.jpg';
    }

    // カテゴリーセット
    public function setCategory()
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
                $value->content = $df->formatLenthgCut($value->origin_text, config('const.TEXT_LENGTH90'));
                $value->category = $df->formatSelect($value->category, $this->setCategory());
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
            $data->category = $df->formatSelect($data->category, $this->setCategory());
            $data->image_path = $this->setImagePath($data->image_flg, $data->id);
            $data->nice = $this->setNice($data->nice);
        }

        return $data;
    }
}
?>