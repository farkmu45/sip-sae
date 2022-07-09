<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\FemaleAnthropometryChart;
use App\Filament\Widgets\MaleAnthropometryChart;
use Filament\Pages\Page;

class NutritionsGraph extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.nutritions-graph';
    protected function getTitle(): string
    {
        return __('text.nutritions_graph');
    }

    protected static function getNavigationLabel(): string
    {
        return __('text.nutritions_graph');
    }


    protected function getFooterWidgets(): array
    {
        return [
            MaleAnthropometryChart::class,
            FemaleAnthropometryChart::class
        ];
    }
}
