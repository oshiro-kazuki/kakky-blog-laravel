<?php

namespace App\Libs;

use App\Model\Owners;
use Auth;

class Owner
{
    // 認証に成功したオーナー情報を取得
    public function getOwner()
    {
        $owner = Owners::where('id', Auth::id())->get();;
        return $owner;
    }
}
?>