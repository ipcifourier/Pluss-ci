<?php

//namespace App\Filament\Resources\Subscribers\Schemas;

/*use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

class SubscriberForm
{
    public static function schema(): array
    {
        return [
            Layouts\Section::make('Informations Abonné')
                ->schema([
                    Fields\TextInput::make('email')
                        ->label('Adresse E-mail')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->columnSpanFull(),

                    // Gestion intelligente du statut
                    Fields\Toggle::make('is_subscribed')
                        ->label('Abonnement Actif')
                        ->onColor('success')
                        ->offColor('danger')
                        // Si unsubscribed_at est vide, alors il est abonné (True)
                        ->formatStateUsing(fn ($record) => $record ? is_null($record->unsubscribed_at) : true)
                        // Si on désactive (False), on met la date du jour. Si on active, on met null.
                        ->dehydrateStateUsing(fn ($state) => $state ? null : now()),
                ]),
        ];
    }
}*/


namespace App\Filament\Resources\Subscribers\Schemas;

use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

class SubscriberForm
{
    public static function schema(): array
    {
        return [
            Layouts\Section::make('Informations Abonné')
                ->schema([
                    // 1. AJOUT DU CHAMP NOM ICI 👇
                    Fields\TextInput::make('name')
                        ->label('Nom complet')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Ex: Jean Kouassi')
                        ->columnSpanFull(),

                    // 2. LE CHAMP EMAIL (On ne change rien)
                    Fields\TextInput::make('email')
                        ->label('Adresse E-mail')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->columnSpanFull(),

                    // 3. LE STATUT (On garde ta logique intelligente)
                    Fields\Toggle::make('is_subscribed') // Attention: assure-toi que ce champ virtuel est géré coté Modèle ou Resource
                        ->label('Abonnement Actif')
                        ->onColor('success')
                        ->offColor('danger')
                        ->formatStateUsing(fn ($record) => $record ? is_null($record->unsubscribed_at) : true)
                        // Note: Le toggle renvoie true/false, il faudra s'assurer que le Resource transforme ça en date
                        ->dehydrateStateUsing(fn ($state) => $state ? null : now()),
                ]),
        ];
    }
}