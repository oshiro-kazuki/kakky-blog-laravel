<?php

namespace App\Libs;

use Illuminate\Support\Facades\DB;
use App\Model\Blogs;
use App\Libs\Common\DataFormat;

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

    public function getCategoryCount()
    {
        $category_list = Blogs::groupBy('category')
        ->select(DB::raw('category, COUNT(category) as category_count'))
        ->get();

        foreach($category_list as $list){
            foreach($this->setCategory() as $key => $value){
                if($list->category === $value){
                    $list->category_nm = $key;
                }
            }
        }

        return $category_list;
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
                'reference_text1'   => $postData['reference_text1'],
                'reference_link1'   => $postData['reference_link1'],
                'reference_text2'   => $postData['reference_text2'],
                'reference_link2'   => $postData['reference_link2'],
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

    // ブログカテゴリ習得
    public function getCategoryBlog(string $category)
    {
        return Blogs::where('category', $category)
        ->orderBy('created_at', 'desc')
        ->get();
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
        return array(
            '選択'  => 'none',
            '日常'  => 'every',
            'コード' => 'code',
            '観光'  => 'tourism',
            '本'    => 'book',
            '金融'  => 'finance',
        );
    }

    // include用カセット
    public function setBlogCassette($limit = false, $category = false)
    {
        if($category){
            $list = $this->getCategoryBlog($category);
        }else if($limit){
            $list = $this->getBlogListLimit($limit);
        }else{
            $list = $this->getBlogList();
        }

        // ブログ情報を整形
        if(count($list) > 0){
            $df = new DataFormat();
            foreach ($list as $key => $value) {
                $value->created_at_date = $df->formatYmd($value->created_at);
                $value->content = $df->formatLenthgCut($value->origin_text, config('const.TEXT_LENGTH90'));
                $value->image_path = $this->setImagePath($value->image_flg, $value->id);
                $value->nice = $this->setNice($value->nice);
                $value->category_nm = $df->formatSelect($value->category, $this->setCategory());
                $value->link = $this->setBlogLink($value->category, $value->id);
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
            $data->category_nm = $df->formatSelect($data->category, $this->setCategory());
            $data->image_path = $this->setImagePath($data->image_flg, $data->id);
            $data->nice = $this->setNice($data->nice);
            if((isset($data->reference_text1) && isset($data->reference_link1)) || (isset($data->reference_text2) && isset($data->reference_link2))){
                $data->reference = $this->setReference($data->reference_text1, $data->reference_link1, $data->reference_text2, $data->reference_link2);
            }
            $data->description = $df->formatLenthgCut($data->origin_text, config('const.TEXT_LENGTH90'));
            $data->date = $df->formatYmd($data->created_at);
        }

        return $data;
    }

    // 参考リンク
    private function setReference($reference_text1, $reference_link1,$reference_text2, $reference_link2)
    {
        $reference = [];
        $count = 0;

        if(!is_null($reference_text1) && !is_null($reference_link1)){
            $reference[$count]['title'] = $reference_text1;
            $reference[$count]['link'] = $reference_link1;
            if(!is_null($reference_text2) && !is_null($reference_link2)){
                ++$count;
                $reference[$count]['title'] = $reference_text2;
                $reference[$count]['link'] = $reference_link2;
            }
        }

        return $reference;
    }

    // ブログ詳細リンク整形
    private function setBlogLink(string $category, string $id)
    {
        return $category . '/' . $id;
    }
}
?>