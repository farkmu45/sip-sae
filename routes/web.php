<?php

use App\Models\MaleAnthropometry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return MaleAnthropometry::where('month', '=', 0)
    ->orWhere([
        ['month', '=', 1],
        ['year', '=', 5],
    ])
    ->orWhere('month', '=', 3)
    ->orWhere('month', '=', 6)
    ->orWhere('month', '=', 9)
    ->get();
});
