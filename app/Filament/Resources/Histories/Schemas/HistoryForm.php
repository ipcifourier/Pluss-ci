<?php

namespace App\Filament\Resources\Histories\Schemas;

use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

class HistoryForm
{
    public static function schema(): array
    {
        return [
            Layouts\Grid::make(1)
                ->schema([
                    Fields\TextInput::make('year')
                        ->label('Année')
                        ->numeric()
                        ->required()
                        ->unique(ignoreRecord: true),

                    Fields\RichEditor::make('content')
                        ->label('Acquis et Informations')
                        ->required()
                        ->toolbarButtons([
                            'bold', 'italic', 'bulletList', 'orderedList', 'link', 'h2', 'h3'
                        ]),

                    Fields\Toggle::make('is_active')
                        ->label('Afficher sur le site')
                        ->default(true),
                ]),
        ];
    }
}