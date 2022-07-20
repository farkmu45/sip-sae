<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use Filament\Facades\Filament;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

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
                Card::make([
                    TextInput::make('nip')
                        ->label(__('text.nip'))
                        ->unique(ignoreRecord: true)
                        ->minLength(5)
                        ->maxLength(5)
                        ->required(),
                    TextInput::make('name')
                        ->label(__('text.name'))
                        ->required(),
                    TextInput::make('address')
                        ->label(__('text.address'))
                        ->required(),
                    Select::make('classroom_id')
                        ->relationship('classroom', 'name')
                        ->label(__('text.classroom'))
                        ->required(),
                    TextInput::make('password')
                        ->label(__('text.password'))
                        ->password()
                        ->minLength(8)
                        ->columnSpan(2)
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                ])->columns(2)
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
                    ->sortable()
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('nip', '!=', auth()->user()->nip);
    }
}
