<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập :attribute đăng nhập.',
            'email.email' => ':attribute đăng nhập phải là địa chỉ :attribute hợp lệ.',
            'password.required' => 'Vui lòng nhập :attribute đăng nhập.',
            'password.min' => ':attribute đăng nhập phải có ít nhất :min ký tự.'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Mật khẩu'
        ];
    }
}
