<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NarrationResource\Pages;
use App\Models\Narration;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Livewire\Component;

class NarrationResource extends Resource
{
    protected static ?string $model = Narration::class;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getModelLabel(): string
    {
        return __('text.narration');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([

            Card::make()->schema([
                FileUpload::make('picture')
                    ->image()
                    ->maxSize(2000)
                    ->imagePreviewHeight(400)
                    ->imageCropAspectRatio('16:9')
                    ->image()
                    ->directory('narration-images')
                    ->label(__('text.picture')),
            ]),

            Card::make()->schema([
                Toggle::make('is_published')
                    ->hidden(fn (Component $livewire): bool => $livewire instanceof Pages\CreateNarration)
                    ->label(__('text.is_published')),
                TextInput::make('title')
                    ->label(__('text.title'))
                    ->required(),
                Textarea::make('content')
                    ->label(__('text.content'))
                    ->required(),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->label(__('text.title'))
                    ->searchable(),
                BooleanColumn::make('is_published')
                    ->label(__('text.is_published')),
                TextColumn::make('content')
                    ->label(__('text.content'))
                    ->sortable()
                    ->searchable()
                    ->limit(50)
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label(__('text.is_published'))
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
            'index' => Pages\ListNarrations::route('/'),
            'create' => Pages\CreateNarration::route('/create'),
            'edit' => Pages\EditNarration::route('/{record}/edit'),
        ];
    }
}
