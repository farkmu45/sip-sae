<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NarrationController;
use App\Http\Controllers\NutritionMeasurementController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/narrations', [NarrationController::class, 'getAll']);
    Route::post('/nutrition-measurements', [NutritionMeasurementController::class, 'create']);
    Route::get('/nutrition-measurements', [NutritionMeasurementController::class, 'getAll']);
    Route::post('/questions', [QuestionController::class, 'create']);
});
