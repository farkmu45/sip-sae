<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Actions;
use Filament\Resources\Pages\Concerns\HasWizard;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    use HasWizard;

    protected static string $resource = StudentResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make(__('text.student_data'))
                ->schema([
                    Card::make([
                        TextInput::make('nis')
                            ->numeric()
                            ->label(__('text.nis'))
                            ->required(),
                        TextInput::make('name')
                            ->label(__('text.name'))
                            ->required(),
                        TextInput::make('address')
                            ->label(__('text.address'))
                            ->required(),
                        DatePicker::make('date_of_birth')
                            ->label(__('text.date_of_birth'))
                            ->maxDate(now())
                            ->required(),
                        Select::make('classroom_id')
                            ->relationship('classroom', 'name')
                            ->label(__('text.classroom'))
                            ->required(),
                        Radio::make('gender')
                            ->label(__('text.gender'))
                            ->options([
                                'MALE' => __('text.male'),
                                'FEMALE' => __('text.female'),
                            ])
                            ->required(),
                    ])
                        ->columns(2)
                ]),
            Step::make(__('text.parents_data'))
                ->schema([
                    Card::make([
                        Select::make('job_id')
                            ->relationship('job', 'name')
                            ->label(__('text.job'))
                            ->required()
                            ->createOptionForm(
                                [
                                    TextInput::make('name')
                                        ->label(__('text.job'))
                                        ->required()
                                ]
                            ),
                        TextInput::make('salary')
                            ->label(__('text.salary'))
                            ->minValue(0)
                            ->numeric()
                            ->required()
                            ->mask(fn (TextInput\Mask $mask) => $mask->money('Rp', '.', 0)),
                        TextInput::make('marital_status_of_parents')
                            ->label(__('text.marital_status'))
                            ->required()
                            ->columnSpan(2)
                    ])->columns(2)
                ]),
            Step::make(__('text.other_information'))
                ->schema([
                    Card::make([
                        TextInput::make('school_distance')
                            ->label(__('text.school_distance'))
                            ->required()
                            ->numeric()
                    ])
                ])
        ];
    }
}
