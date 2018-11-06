<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:64',
            'description' => 'required',
            'start' => 'required|date',
            'finish' => 'required|date|after:start',
            'freeze' => 'required|integer|min:0'
        ];
    }
}
