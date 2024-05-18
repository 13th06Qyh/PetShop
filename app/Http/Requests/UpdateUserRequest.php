<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'email'=> 'required|unique:users|max:255|min:1',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.min' => 'Email quá ngắn',
            'email.max' => 'Email quá dài',
        ];
    }
}