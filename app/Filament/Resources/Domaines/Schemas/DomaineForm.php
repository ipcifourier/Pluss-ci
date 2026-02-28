<?php

namespace App\Filament\Resources\Domaines\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DomaineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Le slug doit être unique et ne peut pas être modifié une fois créé.')
                    ->disabled(fn ($record) => $record !== null) // Désactive le champ si le record existe (édition)
                    ->dehydrated(fn ($record) => $record !== null), // Ne pas supprimer les données existantes lors de l'édition
                Textarea::make('description_courte')
                    ->default(null)
                    ->columnSpanFull(),
                RichEditor::make('contenu')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('icone')
                    //->default(null)
                    ->label('Icône (classe)')
                ->placeholder('ex: heroicon-o-star'),
                FileUpload::make('image_couverture')
                    ->label('Image de couverture')
                    ->image()
                    ->directory('domaines/couvertures')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
    ])
    ->columnSpanFull(),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('est_actif')
                    ->required()
                    ->label('Actif')
            ]);
    }
}
