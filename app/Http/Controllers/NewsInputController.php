<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\NewsList;

class NewsInputController extends Controller
{
    public function __construct()
    {
        $this->title_length = config('const.TITLE_LENGTH');
        $this->text_length  = config('const.INPUT_TEXT_LENGTH');
        $this->middleware('auth:owner');
    }
    
    public function index()
    {
        return view('.owner.news_input');
    }

    public function newsPost(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->fails()){
            return redirect('/owner/news_input')->withErrors($validator)->withInput();
        }
        $postData = $request->all();
        NewsList::insertGetId(
            [
                'created_at' => date('Y-m-d H:i:s'),
                'title' => $postData['title'],
                'content' => $postData['content']
            ]
        );
        return redirect('/owner');
    }

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'title'     => 'required|string|max:'.$this->title_length,
            'content'   => 'required|string|max:'.$this->text_length,
        ]);
    }
}