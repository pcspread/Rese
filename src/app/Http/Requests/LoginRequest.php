<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:191'],
            'password' => ['required', 'regex:/^[A-Za-z0-9]+$/', 'min:8', 'max:191']
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
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスを正しい形式で入力してください',
            'email.max' => 'メールアドレスは191文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'regex' => 'パスワードは半角英数字8文字以上で入力してください',
            'min' => 'パスワードは半角英数字8文字以上で入力してください',
            'max' => 'パスワードは191文字以内で入力してください'
        ];
    }
}
