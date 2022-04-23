<?php

namespace App\Libs;

class ErrorPage
{
    // 画面を表示しない
    public function nonePage()
    {
        return response()->view('error.none_page', [], 404);
    }

    // 不正なアクセス
    public function unauthorized_access()
    {
        return response()->view('error.unauthorized_access', [], 401);
    }
}
?>