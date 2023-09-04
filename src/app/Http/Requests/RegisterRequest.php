<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users', 'max:191'],
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
            'name.required' => 'お名前を入力してください',
            'name.string' => 'お名前は文字列で入力してください',
            'name.max' => 'お名前は191文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスを正しい形式で入力してください',
            'email.unique' => '既に登録されたメールアドレスです',
            'email.max' => 'メールアドレスは191文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'regex' => 'パスワードは半角英数字8文字以上で入力してください',
            'min' => 'パスワードは半角英数字8文字以上で入力してください',
            'max' => 'パスワードは191文字以内で入力してください'
        ];
    }
}
