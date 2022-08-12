<?php

namespace App\Filament\Widgets;

use App\Models\Narration;
use Filament\Widgets\Widget;

class LatestNarration extends Widget
{
    protected function getViewData(): array
    {
        return ['narration' => Narration::where('is_published', '=', true)->latest()->first()];
    }

    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.widgets.latest-narration';
}
