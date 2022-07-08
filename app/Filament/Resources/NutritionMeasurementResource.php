<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NutritionMeasurementResource\Pages;
use App\Filament\Resources\NutritionMeasurementResource\RelationManagers;
use App\Filament\Resources\NutritionMeasurementResource\Widgets\AnthropometryChart;
use App\Models\NutritionMeasurement;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NutritionMeasurementResource extends Resource
{
    protected static ?string $model = NutritionMeasurement::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('text.name') => $record->student->name,
            __('text.imt') => $record->imt,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['student.name', 'imt'];
    }

    public static function getModelLabel(): string
    {
        return __('text.nutrition_measurement');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('student_nis')
                            ->relationship('student', 'name')
                            ->label(__('text.name'))
                            ->required(),
                        TextInput::make('weight')
                            ->label(__('text.weight'))
                            ->helperText(__('text.in_kg'))
                            ->required()
                            ->numeric()
                            ->minValue(1),
                        TextInput::make('height')
                            ->required()
                            ->label(__('text.height'))
                            ->helperText(__('text.in_cm'))
                            ->numeric()
                            ->minValue(1)
                            ->columnSpan([
                                'md' => 2
                            ]),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Card::make()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label(__('text.created_at'))
                            ->content(fn (?NutritionMeasurement $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Placeholder::make('imt')
                            ->label(__('text.imt'))
                            ->content(fn (?NutritionMeasurement $record) => $record ? $record->imt : '-'),
                        Placeholder::make('category')
                            ->label(__('text.status'))
                            ->content(fn (?NutritionMeasurement $record) => $record ? $record->status->category : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label(__('text.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('height_in_meters')
                    ->label(__('text.height_m'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('weight')
                    ->label(__('text.weight_kg'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('imt')
                    ->label(__('text.imt'))
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                //
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

    public static function getWidgets() : array
    {
        return [
            AnthropometryChart::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNutritionMeasurements::route('/'),
            'create' => Pages\CreateNutritionMeasurement::route('/create'),
            'edit' => Pages\EditNutritionMeasurement::route('/{record}/edit'),
        ];
    }
}
