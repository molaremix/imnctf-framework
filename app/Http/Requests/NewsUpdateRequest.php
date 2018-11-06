<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:64',
            'category' => 'required|max:64',
            'content' => 'required'
        ];
    }
}
