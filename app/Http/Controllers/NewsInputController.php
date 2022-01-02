<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\DB;

class NewsInputController extends Controller
{
    public function index()
    {
        return view('/admin/news/news_input');
    }

    public function newsPost(NewsRequest $news_request)
    {
        $postData = $news_request->all();
        DB::table('news_list')->insertGetId(
            [
                'created_at' => date('Y-m-d H:i:s'),
                'title' => $postData['news_input_title'],
                'content' => $postData['news_input_content']
            ]
        );
        return view('top');
    }
}