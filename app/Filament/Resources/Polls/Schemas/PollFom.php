<?php

namespace App\Filament\Resources\Polls\Schemas;

use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

class PollForm
{
    public static function schema(): array
    {
        return [
            Layouts\Section::make('Configuration du Sondage')
                ->schema([
                    Fields\TextInput::make('question')
                        ->label('La Question')
                        ->required()
                        ->columnSpanFull(),

                    // LE REPEATER : Permet d'ajouter N réponses
                    Fields\Repeater::make('options')
                        ->label('Options de réponse')
                        ->schema([
                            // Le texte de la réponse (ex: "Oui", "Non")
                            Fields\TextInput::make('label')
                                ->label('Libellé')
                                ->required(),

                            // Un champ caché pour stocker le nombre de votes (0 au début)
                            Fields\Hidden::make('votes')
                                ->default(0),
                        ])
                        ->addActionLabel('Ajouter une option')
                        ->defaultItems(2) // Par défaut, on affiche 2 champs
                        ->columnSpanFull(),
                ]),

            Layouts\Section::make('Paramètres')
                ->schema([
                    Fields\Toggle::make('is_active')
                        ->label('Sondage actif maintenant')
                        ->default(true),

                    Fields\DatePicker::make('ends_at')
                        ->label('Date de clôture (optionnel)'),
                ])->columns(2),
        ];
    }
}