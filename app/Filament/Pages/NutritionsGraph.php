<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\FemaleAnthropometryChart;
use App\Filament\Widgets\MaleAnthropometryChart;
use App\Models\Classroom;
use App\Models\Student;
use Carbon\Carbon;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class NutritionsGraph extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.nutritions-graph';

    public $start;
    public $end;
    public $classroomId;
    public $studentId;

    protected $queryString = ['start', 'end', 'classroomId', 'studentId'];

    protected function getTitle(): string
    {
        return __('text.nutritions_graph');
    }

    protected static function getNavigationLabel(): string
    {
        return __('text.nutritions_graph');
    }

    public function mount()
    {
        $this->form->fill([
            'start' => $this->start ?? Carbon::now()->subDays(7)->format('Y-m-d'),
            'end' => $this->end ?? Carbon::now()->format('Y-m-d'),
            'classroomId' => $this->classroomId,
            'studentId' => $this->studentId
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make([
                DatePicker::make('start')
                    ->label(__('text.start_date'))
                    ->maxDate(function (callable $get) {
                        return $get('end');
                    }),
                DatePicker::make('end')
                    ->maxDate(now())
                    ->label(__('text.end_date'))
                    ->reactive(),

                Select::make('classroomId')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->placeholder(__('text.all_classroom'))
                    ->afterStateUpdated(function (callable $set)
                    {
                        $set('studentId', null);
                    })
                    ->reactive()
                    ->label(__('text.classroom')),

                Select::make('studentId')
                    ->options(function (callable $get) {
                        if ($get('classroomId')) {
                            $student = Student::where('classroom_id', '=', $get('classroomId'))->pluck('name', 'nis');
                            return $student;
                        } else {
                            return Student::all()->pluck('name', 'nis');
                        }
                    })
                    ->searchable()
                    ->placeholder(__('text.all_student'))
                    ->label(__('text.student'))
            ])->columns(2)

        ];
    }

    public function submit(): void
    {
        $this->validate();
        $url = "/admin/nutritions-graph?start=$this->start&end=$this->end&classroomId=$this->classroomId&studentId=$this->studentId";
        redirect($url);
    }


    protected function getFooterWidgets(): array
    {
        return [
            MaleAnthropometryChart::class,
            FemaleAnthropometryChart::class
        ];
    }
}
