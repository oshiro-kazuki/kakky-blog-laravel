<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'news_input_title'   => 'required|max:20',
            'news_input_content' => 'required|max:140',
        ];
    }

     /**
     * バリデーションエラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'news_input_title.required'     => 'タイトルを入力してください。',
            'news_input_title.max'          => '文字数が上限値を超えています。',
            'news_input_content.required'   => '本文を入力してください。',
            'news_input_content.max'        => '文字数が上限値を超えています。',
        ];
    }
}
