<?php

namespace App\Filament\Resources\Polls\Tables;

use Filament\Tables;

class PollTable
{
    public static function columns(): array
    {
        return [
            Tables\Columns\TextColumn::make('question')
                ->searchable()
                ->limit(50), // On coupe si c'est trop long

            Tables\Columns\TextColumn::make('created_at')
                ->label('Créé le')
                ->date('d/m/Y'),

            Tables\Columns\TextColumn::make('ends_at')
                ->label('Fin le')
                ->date('d/m/Y')
                ->placeholder('Jamais'),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean()
                ->label('Actif'),
        ];
    }
}