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
            'student_nis' => 'required|unique:users|min:4|exists:students,nis',
            'password' => 'required|min:6',
        ];
    }

    public function attributes(): array
    {
        return [
            'student_nis' => 'NIS',
        ];
    }
}
