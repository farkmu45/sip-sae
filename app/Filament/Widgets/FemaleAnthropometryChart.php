<?php

namespace App\Filament\Widgets;

use App\Enums\Gender;
use App\Models\FemaleAnthropometry;
use App\Models\NutritionMeasurement;
use Carbon\Carbon;
use Filament\Widgets\ScatterChartWidget;

class FemaleAnthropometryChart extends ScatterChartWidget
{
    // Please refactor
    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = null;

    public $records = null;

    public function mount()
    {
        $startDate = request()->start !== null ? Carbon::parse(request()->start)->startOfDay() : Carbon::now()->subDays(7);
        $endDate = request()->end !== null ? Carbon::parse(request()->end)->endOfDay() : Carbon::now();
        $studentId = request()->studentId;
        $classroomId = request()->classroomId;

        $this->records = NutritionMeasurement::whereBetween('created_at', [$startDate, $endDate])
            ->whereHas('student', function ($q) use ($classroomId, $studentId) {
                $q->where('gender', Gender::FEMALE->value);

                if ($classroomId) {
                    $q->where('classroom_id', $classroomId);
                }

                if ($studentId) {
                    $q->where('nis', $studentId);
                }
            })
            ->get();
    }

    protected function getHeading(): string
    {
        return __('text.female_graph');
    }

    protected function getData(): array
    {
        $datasets = [];
        $data = [];
        $sdList = [
            ['-3sd', '#302f2e'],
            ['-2sd', '#b7556b'],
            ['-1sd', '#c79f6d'],
            ['median', '#86af8b'],
            ['+1sd', '#deb57b'],
            ['+2sd', '#b7556b'],
            ['+3sd', '#302f2e'],
        ];

        $anthropometry = FemaleAnthropometry::where('month', '=', 0)
            ->orWhere([
                ['month', '=', 1],
                ['year', '=', 5],
            ])
            ->orWhere('month', '=', 3)
            ->orWhere('month', '=', 6)
            ->orWhere('month', '=', 9)
            ->get();

        $anthropometryArray = collect($anthropometry);

        foreach ($sdList as $sd) {
            foreach ($anthropometryArray as $anthropometry) {
                array_push($data, [
                    'y' => $anthropometry[$sd[0]],
                    'x' => round((float) "$anthropometry->year.$anthropometry->month", 3),
                ]);
            }

            array_push($datasets, [
                'label' => strtoupper($sd[0]),
                'data' => $data,
                'borderColor' => $sd[1],
                'pointRadius' => 0,
            ]);

            $data = [];
        }

        foreach ($this->records as $measurement) {
            $age = $measurement->student->age;
            $ageMonth = $measurement->student->ageMonth;

            array_push($datasets, [
                'label' => 'IMT',
                'data' => [
                    [
                        'y' => $measurement->imt,
                        'x' => (float) "$age.$ageMonth",
                    ],
                ],
                'pointRadius' => 8,
                'pointBackgroundColor' => 'blue',
                'borderColor' => 'blue',
                'pointHoverRadius' => 10,
            ]);
        }

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
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
