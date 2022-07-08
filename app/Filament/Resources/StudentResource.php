<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    public static function getModelLabel(): string
    {
        return Str::lower(__('text.student_data'));
    }

    public static function getPluralModelLabel(): string
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
                                ->maxLength(45)
                                ->required(),
                            TextInput::make('address')
                                ->label(__('text.address'))
                                ->maxLength(45)
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
                                    Gender::MALE->value => __('text.male'),
                                    Gender::FEMALE->value => __('text.female'),
                                ])
                                ->required(),

                        ]
                    )
                    ->columns(2),


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
                                        ->required()
                                ]
                            ),
                        TextInput::make('salary')
                            ->label(__('text.salary'))
                            ->minValue(1)
                            ->numeric()
                            ->required()
                            ->mask(fn (TextInput\Mask $mask) => $mask->money('Rp', '.', 0)),
                        TextInput::make('marital_status_of_parents')
                            ->label(__('text.marital_status'))
                            ->maxLength(45)
                            ->required()
                            ->columnSpan(2)
                    ])
                    ->columns(2),

                Section::make(__('text.other_information'))
                    ->schema([
                        TextInput::make('school_distance')
                            ->label(__('text.school_distance'))
                            ->required()
                            ->numeric()
                    ])
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
                TextColumn::make('age')
                    ->label(__('text.age')),
                TextColumn::make('classroom.name')
                    ->label(__('text.classroom')),
                TextColumn::make('address')
                    ->searchable()
                    ->label(__('text.address'))
            ])
            ->filters([
                SelectFilter::make('classroom_id')
                    ->relationship('classroom', 'name')
                    ->label(__('text.classroom'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
