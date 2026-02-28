<?php

namespace App\Filament\Resources\Media\Tables;

// 👇 LES BONS IMPORTS (Copiés de ton fichier PagesTable qui marche)
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction; // Ajouté pour la suppression
use Filament\Actions\EditAction;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Titre
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                // 2. Type (Badge couleur)
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'audio' => 'success',
                        'video' => 'danger',
                        'album' => 'warning',
                        default => 'gray',
                    }),

                // 3. Visible
                IconColumn::make('is_public')
                    ->label('Visible')
                    ->boolean(),

                // 4. Date
                TextColumn::make('published_at')
                    ->label('Date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            // 👇 On utilise la syntaxe standard "actions" 
            // Si ça ne marche pas, on essaiera "recordActions" comme dans ton exemple
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}