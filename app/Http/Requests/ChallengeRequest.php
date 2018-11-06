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
            'submission_limit' => 'nullable|numeric|min:1',
            'visible' => 'required',
            'point_mode' => 'in:static,dynamic',
            'decay' => 'required_if:point_mode,dynamic',
            'minimum' => 'required_if:point_mode,dynamic|lt:point',
            'attachments' => 'nullable',
            'attachments.*' => 'mimes:zip|max:2000'
        ];
        return $rules;
    }
}
