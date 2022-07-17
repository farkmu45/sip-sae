<?php

namespace App\Http\Controllers;

use App\Http\Resources\NarrationResource;
use App\Models\Narration;

class NarrationController extends Controller
{
    public function getAll()
    {
        return NarrationResource::collection(Narration::where('is_published', true)->latest()->paginate(5));
    }
}
