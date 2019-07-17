<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * フォームリクエストにより使用されているメッセージはmessageメソッドを
     * オーバーライドすることによりカスタマイズできます。
     * このメソッドから属性／ルールと対応するエラーメッセージのペアを配列で返してください。
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:30',
            'content' => 'required',
        ];
    }
    /**
    * 定義済みバリデーションルールのエラーメッセージ取得
    *
    * @return array
    */

    public function messages()
    {
        return[
            'title.required' => 'タイトルを入力してください',
            'title.min' => 'タイトルは３文字以上にしてください',
            'title.max' => 'タイトルは30文字以内にしてください',
            'content.required' => '本文を入力してください'
        ];
    }
}
