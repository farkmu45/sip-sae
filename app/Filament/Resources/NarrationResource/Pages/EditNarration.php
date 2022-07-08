<?php

namespace App\Filament\Resources\NarrationResource\Pages;

use App\Filament\Resources\NarrationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNarration extends EditRecord
{
    protected static string $resource = NarrationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
