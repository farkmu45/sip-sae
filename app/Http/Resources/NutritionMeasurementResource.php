<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NutritionMeasurementResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status->category,
            'imt' => $this->imt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
