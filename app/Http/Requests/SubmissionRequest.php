<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmissionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'challenge_id' => 'required|exists:challenges,id',
            'flag' => Rule::unique('submissions')->where(function ($query){
                return $query->where('team_id', $this->user()['id'])->where('challenge_id', $this->get('challenge_id'));
            }),
        ];
    }

    public function messages()
    {
        return [
            'flag.unique' => 'Flag already submitted'
        ];
    }
}
