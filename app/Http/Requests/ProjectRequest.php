<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'budget' => 'required|max:255',
            'text' => 'required|max:255',
        ];
    }
}
