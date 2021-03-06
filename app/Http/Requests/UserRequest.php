<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|unique:users|min:6|max:255',
            'phone' => 'required|digits:11',
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required_with:password|same:password|string|min:8|max:255',
        ];
    }
}
