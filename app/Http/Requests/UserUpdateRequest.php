<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|digits:11',
            'password' => 'required|string|min:8|max:255',
            'new_password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required_with:new_password|same:new_password|string|min:8|max:255',
        ];
    }
}
