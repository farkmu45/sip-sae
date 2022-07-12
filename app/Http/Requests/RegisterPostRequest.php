<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'nis' => 'required|unique:users|min:4',
            'password' => 'required|min:6'
        ];
    }

    public function attributes(): array
    {
        return [
            'nis' => 'NIS',
        ];
    }
}
