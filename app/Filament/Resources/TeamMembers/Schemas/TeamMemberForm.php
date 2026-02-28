<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

class TeamMemberForm
{
    public static function schema(): array
    {
        return [
            Layouts\Tabs::make('MembreEquipe')
                ->tabs([

                    /*
                    |--------------------------------------------------------------------------
                    | INFORMATIONS
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Informations')
                        ->schema([
                            Layouts\Grid::make(2)
                                ->schema([
                                    Fields\TextInput::make('name')
                                        ->label('Nom complet')
                                        ->required()
                                        ->maxLength(255),

                                    Fields\TextInput::make('position')
                                        ->label('Fonction exacte')
                                        ->required()
                                        ->maxLength(255),

                                    Fields\Select::make('department')
                                        ->label('Pôle d\'appartenance')
                                        ->options([
                                            'Secrétariat Multisectoriel' => 'Secrétariat Multisectoriel',
                                            'Équipe d\'appui' => 'Équipe d\'appui',
                                        ])
                                        ->required()
                                        ->columnSpanFull(),

                                    Fields\TextInput::make('sort_order')
                                        ->label('Ordre d\'affichage')
                                        ->numeric()
                                        ->default(10)
                                        ->helperText('Ex: 0 pour la Coordonnatrice (apparaît en premier).'),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | DÉTAILS / BIO
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Détails')
                        ->schema([
                            Layouts\Grid::make(1)
                                ->schema([
                                    Fields\Textarea::make('description')
                                        ->label('Description courte ou missions')
                                        ->rows(4)
                                        ->maxLength(1000),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | MÉDIAS
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Médias')
                        ->schema([
                            Layouts\Grid::make(1)
                                ->schema([
                                    Fields\FileUpload::make('image_path')
                                        ->label('Photo de profil')
                                        ->image()
                                        ->imagePreviewHeight('150')
                                        ->imageCropAspectRatio('1:1')
                                        ->directory('team/photos')
                                        ->disk('public')
                                        ->maxSize(2048),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | VISIBILITÉ
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Publication')
                        ->schema([
                            Layouts\Grid::make(1)
                                ->schema([
                                    Fields\Toggle::make('is_active')
                                        ->label('Afficher sur la plateforme')
                                        ->default(true),
                                ]),
                        ]),

                ])
                ->columnSpanFull(),
        ];
    }
}