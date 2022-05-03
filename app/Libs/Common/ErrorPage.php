<?php

namespace App\Libs\Common;

class ErrorPage
{
    // 画面を表示しない
    public function nonePage()
    {
        // Webページが見つからない
        return response()->view('error.none_page', [], 404);
    }

    // 不正なアクセス
    public function unauthorized_access()
    {
        // アクセス権が無い、または認証に失敗
        return response()->view('error.unauthorized_access', [], 401);
    }

    // 登録・更新失敗
    public function noneRegisterEdit()
    {
        // サーバ側が受付不可能な値（ファイルの種類など）であり提供できない状態
        return response()->view('error.none_register_edit', [], 406);
    }
}
?>