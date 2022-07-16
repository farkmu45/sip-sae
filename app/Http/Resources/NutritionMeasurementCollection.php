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
                'weight' => $measurement->weight,
                'height' => $measurement->height_in_meters,
                'status' => $measurement->status->category,
                'imt' => $measurement->imt,
                'created_at' => $measurement->created_at,
                'updated_at' => $measurement->updated_at,
            ]
        );
    }
}
