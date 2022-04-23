<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Common\OpenGraphProtocol;
use App\Libs\Common\Breadcrumb;

class InfoController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request      = $request;
        $this->host         = $this->request->server('HTTP_HOST');
        $this->uri          = $this->request->server('REQUEST_URI');
        $this->breadcrumb   = new Breadcrumb($this->uri);
    }

    public function showPrivacyPolicy()
    {
        $title = 'プライバシーポリシー';
        $description = 'kakky-blogのプライバシーポリシー画面です。';
        $breadcrumb = $this->breadcrumb->getBreadcrumb();
        $info_css = 'css/info/privacy_policy.css';
        $screen_nm = '/privacy_policy';

        return $this->showList($title, $description, $breadcrumb, $info_css, $screen_nm);
    }

    public function showProfile()
    {
        $title = 'プロフィール';
        $description = 'koのプロフィール画面です。';
        $breadcrumb = $this->breadcrumb->getBreadcrumb();
        $info_css = 'css/info/profile.css';
        $screen_nm = '/profile';

        return $this->showList($title, $description, $breadcrumb, $info_css, $screen_nm);
    }

    private function showList(string $title, string $description, array $breadcrumb, string $info_css, string $screen_nm)
    {
        $ogp = new OpenGraphProtocol($this->host, $this->uri, $title, $description);

        return view('/info'. $screen_nm,
            [
                'title'         => $title,
                'description'   => $description,
                'ogp'           => $ogp,
                'breadcrumb'    => $breadcrumb,
                'info_css'      => $info_css,
            ]
        );
    }
}