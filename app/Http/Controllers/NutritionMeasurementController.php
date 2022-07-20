<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionMeasurementPostRequest;
use App\Http\Resources\NutritionMeasurementCollection;
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

    public function getAll()
    {
        return new NutritionMeasurementCollection(
            auth()
                ->user()
                ->student
                ->measurements()
                ->latest()
                ->paginate(20)
        );
    }
}
