<?php

namespace App\Filament\Resources\Zoonoses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ZoonoseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str()->slug($state)) ),
                    
                TextInput::make('slug')
                    ->required()
                    ->unique(table: 'zoonoses', ignorable: fn ($record) => $record),
                Textarea::make('description_courte')
                    ->default(null)
                    ->label('Description courte')
                    ->rows(3)
                    ->maxLength(255)
                    ->columnSpanFull(),
                RichEditor::make('contenu')
                    ->required()
                    ->label('Description détaillée')
                    ->columnSpanFull(),
                TextInput::make('icone')
                    ->label('Icône (classe FontAwesome)')
                    ->placeholder('ex: fa-solid fa-virus')
                    ->default(null),
                FileUpload::make('image_illustration')
                    ->label('Image d\'illustration')
                    ->image()
                    ->directory('zoonoses')
                    ->maxSize(2048),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('est_actif')
                    ->required(),
            ]);
    }
}
