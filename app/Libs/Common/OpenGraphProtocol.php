<?php

namespace App\Libs\Common;

//　画面情報共通化クラス
class OpenGraphProtocol
{
    private $is_host    = '';
    private $is_route   = '';

    public function __construct($host, $route, $title, $description)
    {
        $this->is_host      = $host;
        $this->is_route     = $route;
        $this->title        = $title;
        $this->description  = $description;
        $this->type         = $this->getType();
        $this->url          = $this->getUrl();
        $this->image_url    = $this->getImageUrl();
        $this->site_name    = config('app.name');
    }

    public function getType()
    {
        $type = '';
        switch($this->is_route){
            case '/':
            case '/blog':
                $type = 'website';
                break;
            case strpos($this->is_route, '/blog/')  !== false :
                $type = 'blog';
                break;
        }
        return $type;
    }

    public function getUrl()
    {
        $route = '';
        if($this->is_route !== '/'){
            $route = $this->is_route;
        }
        return $this->setDomain() . $route;
    }

    public function getImageUrl()
    {
        return $this->setDomain() . '/img/ogp_image.jpg';
    }

    // ドメインセット
    private function setDomain()
    {
        return $this->setHttp() . '://' .  $this->is_host;
    }

    // httpの設定
    private function setHttp()
    {
        return config('app.env') === 'local' ? 'http' : 'https';
    }
}
?>