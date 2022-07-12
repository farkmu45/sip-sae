<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionMeasurementPostRequest;
use App\Http\Resources\NutritionMeasurementResource;
use App\Models\NutritionMeasurement;
use Illuminate\Http\Request;

class NutritionMeasurementController extends Controller
{
    public function create(NutritionMeasurementPostRequest $request)
    {
        $data = $request->validated();
        $data['student_nis'] = auth()->user()->student_nis;
        return new NutritionMeasurementResource(NutritionMeasurement::create($data));
    }
}
