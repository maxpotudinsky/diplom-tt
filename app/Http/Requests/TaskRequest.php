<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'text' => 'required|string',
            'time' => 'required|numeric|min:0|max:100',
            'fact_time' => 'required|numeric|max:100',
            'price' => 'required|numeric|min:0|max:1000000',
            'limit' => 'required|numeric|min:1|max:150',
            'importance' => 'required|numeric|min:-100|max:100',
        ];
    }
}
