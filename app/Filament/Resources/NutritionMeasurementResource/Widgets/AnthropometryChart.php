<?php

namespace App\Filament\Resources\NutritionMeasurementResource\Widgets;

use Illuminate\Database\Eloquent\Model;
use App\Models\MaleAnthropometry;
use Filament\Widgets\LineChartWidget;
use Filament\Widgets\ScatterChartWidget;

class AnthropometryChart extends ScatterChartWidget
{
    // Please refactor
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = null;
    public ?Model $record = null;

    protected function getHeading(): string
    {
        return 'Grafik';
    }

    protected function getData(): array
    {
        $measurement = $this->record;
        $sdList = [
            ['-3sd', 'black'],
            ['-2sd', '#933149'],
            ['-1sd', '#c79f6d'],
            ['median', '#457c40'],
            ['+1sd', '#c79f6d'],
            ['+2sd', '#933149'],
            ['+3sd', 'black']
        ];

        $anthropometry = MaleAnthropometry::where('month', '=', 0)
            ->orWhere([
                ['month', '=', 1],
                ['year', '=', 5],
            ])
            ->orWhere('month', '=', 3)
            ->orWhere('month', '=', 6)
            ->orWhere('month', '=', 9)
            // ->orWhere([
            //     ['year', '=', $measurement->student->age],
            //     ['month', '=', $measurement->student->ageMonth],
            // ])
            ->get();

        $anthropometryArray = collect($anthropometry);
        $datasets = [];
        $data = [];

        foreach ($sdList as $sd) {
            foreach ($anthropometryArray as $anthropometry) {
                array_push($data, [
                    'y' => $anthropometry[$sd[0]],
                    'x' => round((float)"$anthropometry->year.$anthropometry->month", 3)
                ]);
            }

            array_push($datasets, [
                'label' => strtoupper($sd[0]),
                'data' => $data,
                'borderColor' => $sd[1],
                'pointRadius' => 0
            ]);

            $data = [];
        }

        array_push($datasets, [
            'label' => 'IMT',
            'data' => [
                [
                    'y' => $measurement->imt,
                    'x' => 8
                ]
            ],
            'pointRadius' => 8,
            'pointBackgroundColor' => 'blue',
            'borderColor' => 'blue',
            'pointHoverRadius' => 10,
        ]);

        return [
            'datasets' => $datasets,
        ];
    }

    protected function getOptions(): ?array
    {
        return [
            'showLine' => true,
            'scales' => [
                'x' => [
                    'min' => 5,
                    'max' => 19,
                    'ticks' => [
                        'stepSize' => 1
                    ]
                ]
            ]
        ];
    }
}
