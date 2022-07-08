<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getModelLabel(): string
    {
        return Str::lower(__('text.teacher_data'));
    }

    public static function getPluralModelLabel(): string
    {
        return Str::lower(__('text.teacher'));
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nip')
                    ->label(__('text.nip'))
                    ->required(),
                TextInput::make('name')
                    ->label(__('text.name'))
                    ->required(),
                Select::make('classroom_id')
                    ->relationship('classroom', 'name')
                    ->label(__('text.classroom'))
                    ->columnSpan(2)
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nip')
                    ->label(__('text.nip'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('text.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address')
                    ->label(__('text.address'))
                    ->searchable(),
                TextColumn::make('classroom.name')
                    ->label(__('text.classroom'))
            ])
            ->filters([
                MultiSelectFilter::make('classroom_id')
                    ->relationship('classroom', 'name')
                    ->label(__('text.classroom'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTeachers::route('/'),
        ];
    }
}
