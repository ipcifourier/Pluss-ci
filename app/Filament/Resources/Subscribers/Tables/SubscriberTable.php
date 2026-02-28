<?php

/*namespace App\Filament\Resources\Subscribers\Tables;

use Filament\Tables;

class SubscriberTable
{
    public static function columns(): array
    {
        return [
            Tables\Columns\TextColumn::make('email')
                ->searchable()
                ->copyable() // Très pratique pour copier-coller
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Inscrit le')
                ->date('d/m/Y'),

            Tables\Columns\IconColumn::make('unsubscribed_at')
                ->label('Statut')
                ->boolean()
                ->trueIcon('heroicon-o-x-circle') // Désabonné
                ->falseIcon('heroicon-o-check-circle') // Abonné
                ->trueColor('danger')
                ->falseColor('success')
                // Logique inversée : S'il y a une date (true), c'est qu'il est désabonné
                ->getStateUsing(fn ($record) => !is_null($record->unsubscribed_at)),
        ];
    }
}*/



namespace App\Filament\Resources\Subscribers\Tables;

use Filament\Tables;

class SubscriberTable
{
    public static function columns(): array
    {
        return [
            // 1. NOUVELLE COLONNE NOM 👇
            Tables\Columns\TextColumn::make('name')
                ->label('Nom complet')
                ->searchable() // Permet de chercher par nom
                ->sortable()
                ->weight('bold'), // On met en gras pour le style

            // 2. EMAIL (Ton code existant)
            Tables\Columns\TextColumn::make('email')
                ->searchable()
                ->copyable()
                ->sortable()
                ->icon('heroicon-m-envelope'),

            // 3. DATE D'INSCRIPTION
            Tables\Columns\TextColumn::make('created_at')
                ->label('Inscrit le')
                ->date('d/m/Y')
                ->sortable(),

            // 4. STATUT
            Tables\Columns\IconColumn::make('unsubscribed_at')
                ->label('Statut')
                ->boolean()
                ->trueIcon('heroicon-o-x-circle')
                ->falseIcon('heroicon-o-check-circle')
                ->trueColor('danger')
                ->falseColor('success')
                ->getStateUsing(fn ($record) => !is_null($record->unsubscribed_at)),
        ];
    }
}