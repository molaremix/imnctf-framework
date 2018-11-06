<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'email' => 'required|unique:teams,email',
            'password' => 'required|min:6',
            'confirmation_password' => 'required|same:password',
        ];
    }
}
