<?php

namespace App\Filament\Resources\NarrationResource\Pages;

use App\Filament\Resources\NarrationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNarrations extends ListRecords
{
    protected static string $resource = NarrationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
