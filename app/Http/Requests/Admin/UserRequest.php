<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $uniqueEmail = 'unique:user';

        if (session('id')) {
            $id = session('id');
            $uniqueEmail = 'unique:users,email,' . $id;
        }

        return [
            //
            'username' => 'required|min:5',
            'email' => 'required|email|' . $uniqueEmail,
            'password' => ['required', 'confirmed', Password::min(5)],
            'fullname' => 'required|min:5',
            'dateofbirth' => 'required|date',
            'group_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Chưa nhập :attribute.',
            'email.required' => ':attribute đăng nhập phải là địa chỉ :attribute hợp lệ.',
            'unique' => ':attribute đã tồn tại.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'confirmed' => ':attribute không hợp lệ'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Tên người dùng',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'fullname' => 'Họ và tên',
            'dateofbirth' => 'Ngày sinh',
            'group_id' => 'Quyền truy cập'
        ];
    }
}
