<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255']
        ];
    }

    /**
     * バリデーションメッセージの変更
     * @param void
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '投稿者名を入力してください',
            'name.string' => '投稿者名は文字列で入力してください',
            'name.max:255' => '文字列は255文字以内で入力してください'
        ];
    }
    
}
