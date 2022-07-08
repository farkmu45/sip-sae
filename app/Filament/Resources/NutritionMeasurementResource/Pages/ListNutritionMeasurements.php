<?php

namespace App\Filament\Resources\NutritionMeasurementResource\Pages;

use App\Filament\Resources\NutritionMeasurementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNutritionMeasurements extends ListRecords
{
    protected static string $resource = NutritionMeasurementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
