<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NutritionMeasurementCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($measurement) => [
                'id' => $measurement->id,
                'weight' => (int) $measurement->weight,
                'height' => (float) $measurement->height_in_meters,
                'status' => $measurement->status->category,
                'imt' => (float) $measurement->imt,
                'created_at' => $measurement->created_at,
                'updated_at' => $measurement->updated_at,
            ]
        );
    }
}
