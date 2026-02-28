<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

class PartnerForm
{
    public static function schema(): array
    {
        return [
            Layouts\Grid::make(2)
                ->schema([
                    Fields\TextInput::make('name')
                        ->label('Nom du partenaire')
                        ->required()
                        ->maxLength(255),

                    Fields\TextInput::make('website_url')
                        ->label('Lien du site web')
                        ->url()
                        ->maxLength(255),

                    Fields\FileUpload::make('logo_path')
                        ->label('Logo du partenaire')
                        ->image()
                        ->directory('partners/logos')
                        ->disk('public')
                        ->columnSpanFull(),

                    Fields\Textarea::make('description')
                        ->label('Description de l\'appui ou du partenariat')
                        ->rows(3)
                        ->columnSpanFull(),

                    Fields\TextInput::make('sort_order')
                        ->label('Ordre d\'affichage')
                        ->numeric()
                        ->default(10),

                    Fields\Toggle::make('is_active')
                        ->label('Afficher sur la plateforme')
                        ->default(true),
                ]),
        ];
    }
}