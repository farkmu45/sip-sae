<?php

namespace App\Filament\Resources\ClassroomResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return Str::lower(__('text.student'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('text.student_data'))
                    ->schema(
                        [
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
                        ]
                    ),

                Section::make(__('text.parents_data'))
                    ->schema([
                        Select::make('job_id')
                            ->relationship('job', 'name')
                            ->label(__('text.job'))
                            ->required()
                            ->createOptionForm(
                                [
                                    TextInput::make('name')
                                        ->label(__('text.job'))
                                        ->required(),
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
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make(__('text.other_information'))
                    ->schema([
                        TextInput::make('school_distance')
                            ->label(__('text.school_distance'))
                            ->required()
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')
                    ->label(__('text.nis'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('text.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address')
                    ->searchable()
                    ->label(__('text.address')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
