<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Owners;
use Auth;


class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }    

    public function index()
    {
        $owner_data = $this->getOwner()[0];
        return view('owner.index', ['owner' => $owner_data]);
    }

    // 認証に成功したオーナー情報を取得
    public function getOwner()
    {
        return Owners::where('id', Auth::id())->get();
    }
}