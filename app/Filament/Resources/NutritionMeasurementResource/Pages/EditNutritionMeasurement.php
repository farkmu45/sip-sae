<?php

namespace App\Filament\Resources\NutritionMeasurementResource\Pages;

use App\Filament\Resources\NutritionMeasurementResource;
use App\Filament\Resources\NutritionMeasurementResource\Widgets\AnthropometryChart;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNutritionMeasurement extends EditRecord
{
    protected static string $resource = NutritionMeasurementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AnthropometryChart::class
        ];
    }
}
