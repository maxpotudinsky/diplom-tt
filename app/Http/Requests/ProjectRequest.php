<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'budget' => 'required|integer|min:0|max:500000',
            'text' => 'required|string|max:255',
        ];
    }
}
