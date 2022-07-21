<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getModelLabel(): string
    {
        return Str::lower(__('text.user'));
    }

    public static function getPluralModelLabel(): string
    {
        return Str::lower(__('text.user'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('student_nis')
                        ->relationship('student', 'name', fn (Builder $query) => $query->has('user', '!='))
                        ->label(__('text.student'))
                        ->required()
                        ->searchable(),
                    TextInput::make('password')
                        ->password()
                        ->label(__('text.password'))
                        ->required()
                        ->minLength(8),
                ])->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_nis')
                    ->label(__('text.nis'))
                    ->searchable(),
                TextColumn::make('student.name')
                    ->label(__('text.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('student.classroom.name')
                    ->label(__('text.classroom'))
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('updatePassword')
                    ->icon('heroicon-s-key')
                    ->label(__('text.change_password'))
                    ->modalButton(__('text.save'))
                    ->action(function (User $record, array $data): void {
                        try {
                            $record->update([
                                'password' => Hash::make($data['password']),
                            ]);
                            Filament::notify('success', __('text.password_changed_successfully'));
                        } catch (\Throwable $th) {
                            Filament::notify('danger', __('text.password_failed_to_change'));
                        }
                    })
                    ->form([
                        TextInput::make('password')
                            ->label(__('text.password'))
                            ->password()
                            ->minLength(8),
                    ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
