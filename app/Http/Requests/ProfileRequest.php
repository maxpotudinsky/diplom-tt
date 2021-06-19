<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'photo' => 'mimes:jpg,png',
            'name' => 'required|string|min:3|max:255',
//            'email' => 'required|string|email|unique:users|min:6|max:255',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
                'min:6',
                'max:255',
            ],
            'phone' => 'required|digits:11',
            'password' => 'required|string|min:8|max:255',
            'new_password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required_with:new_password|same:new_password|string|min:8|max:255',
        ];
    }
}
