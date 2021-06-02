<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'text' => 'required|string|max:255',
            'time' => 'required|numeric',
            'fact_time' => 'required|numeric',
            'price' => 'required|numeric|min:1',
            'limit' => 'required|numeric|min:1',
            'importance' => 'required|numeric|min:-100|max:100',
        ];
    }
}
