<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionPostRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function create(QuestionPostRequest $request)
    {
        $data = $request->validated();
        $data['student_nis'] = auth()->user()->student_nis;
        return new QuestionResource(Answer::create($data));
    }
}
