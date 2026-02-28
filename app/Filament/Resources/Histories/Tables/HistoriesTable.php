<?php

namespace App\Filament\Resources\Histories\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns as Columns;

class HistoriesTable

{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('year')
                    ->label('Année')
                    ->sortable()
                    ->weight('bold')
                    ->searchable(),
                Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),
                Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),    

                Columns\ToggleColumn::make('is_active')
                    ->label('Visible'),
            ])
            ->defaultSort('year', 'asc'); // Trie automatiquement du plus ancien au plus récent
    }
}