<?php

namespace App\Http\Controllers;

use App\Http\Resources\NarrationResource;
use App\Models\Narration;
use Illuminate\Http\Request;

class NarrationController extends Controller
{
    public function getAll()
    {
        return NarrationResource::collection(Narration::paginate(5));
    }
}
