<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionPostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question' => 'required|string|max:45',
            'answer' => 'required|string|max:45'
        ];
    }

    public function attributes(): array
    {
        return [
            'question' => __('text.question'),
            'answer' => __('text.answer'),
        ];
    }
}
