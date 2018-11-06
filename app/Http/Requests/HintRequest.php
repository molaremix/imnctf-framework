<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HintRequest extends FormRequest
{
    public function rules()
    {
        return [
            'challenge_id' => 'required|max:20|exists:categories,id',
            'description' => 'required|max:191',
        ];
    }
}
