<?php

namespace App\Libs\Common;

// パンくず
class Breadcrumb
{
    private $is_route           = '';
    private $route_first_arr    = array(
        'ブログ'              => '/blog',
        'お問い合わせ'         => '/contact_mail',
        'プライバシーポリシー'  => '/privacy_policy',
        'プロフィール'         => '/profile',
    );
    private $route_second_arr   = [];
    private $route_last_arr     = [];

    public function __construct($route)
    {
        $this->is_route     = $route;
        $this->route_arr    = explode('/' , $this->is_route);
    }

    public function getBreadcrumb()
    {
        $breadcrumb = ['トップ'  => '/'];
        $count = 0;

        // 1階層判定
        foreach($this->route_first_arr as $key => $value){
            if(strpos($this->is_route, $value) !== false){
                $breadcrumb = array_merge($breadcrumb, [$key => $value]);
                $count++;
            }
        }

        // 2階層判定
        if(count($this->route_second_arr) > 0){
            foreach($this->route_second_arr as $key => $value){
                $val = '/' . $value;
                if(strpos($this->is_route, $val) !== false){
                    $arr_val = array_values($breadcrumb);
                    $breadcrumb = array_merge($breadcrumb, [$key => $arr_val[$count] . $val]);
                    $count++;
                }
            }
        }

        // 最深階層判定
        if(count($this->route_last_arr) > 0){
            foreach($this->route_last_arr as $key => $value){
                $val = '/' . $value;
                if(strpos($this->is_route, $val) !== false){
                    $breadcrumb = array_merge($breadcrumb, [$key => $val]);
                }
            }
        }

        return $breadcrumb;
    }

    public function setSecondArr(array $array)
    {
        $this->route_second_arr = $array;
    }

    public function setLastArr(array $array)
    {
        $this->route_last_arr = $array;
    }
}
?>