<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:32',
            'description' => 'required',
            'flag' => 'required|max:72|unique:challenges,flag',
            'point' => 'required|numeric',
            'submission_limit' => 'required|numeric',
            'visible' => 'required',
            'point_mode' => 'in:static,decrease,attack_defense',
            'attachments' => 'nullable',
            'attachments.*' => 'mimes:zip|max:2000'
        ];
        return $rules;
    }
}
