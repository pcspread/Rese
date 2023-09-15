<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'region' => ['required', 'string', 'max:50'],
            'genre' => ['required', 'string', 'max:50'],
            'photo' => ['required', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * バリデーションメッセージの修正
     * @param void
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '飲食店名を入力してください',
            'name.string' => '飲食店名は文字列で入力してください',
            'name.max' => '飲食店名は191文字以内で入力してください',
            'region.required' => 'エリアを入力してください',
            'region.string' => 'エリアは文字列で入力してください',
            'region.max' => 'エリアは50文字以内で入力してください',
            'genre.required' => 'ジャンルを入力してください',
            'genre.string' => 'ジャンルは文字列で入力してください',
            'genre.max' => 'ジャンルは50文字以内で入力してください',
            'photo.required' => '画像のリンクを入力してください',
            'photo.max' => '画像のリンクは255文字以内で入力してください',
            'description.required' => '説明内容を入力してください',
            'description.string' => '説明内容は文字列で入力してください',
            'description.max' => '説明内容は255文字以内で入力してください',
        ];
    }
}
