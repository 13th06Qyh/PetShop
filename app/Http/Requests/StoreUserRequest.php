<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users|max:255|min:1',
            'email'=> 'required|unique:users|max:255|min:1',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên đăng kí không được để trống',
            'username.unique' => 'Tên đăng kí đã tồn tại',
            'username.min' => 'Tên đăng kí quá ngắn',
            'username.max' => 'Tên đăng kí quá dài',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.min' => 'Email quá ngắn',
            'email.max' => 'Email quá dài',
        ];
    }
}