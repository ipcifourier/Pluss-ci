<?php

namespace App\Filament\Resources\Documents\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Document;

class DocumentTable
{
    public static function columns(): array
    {
        return [
            TextColumn::make('title')
                ->label('Nom du document')
                ->searchable()
                ->limit(30)
                ->sortable(),

            TextColumn::make('type')
                ->badge()
                ->colors([
                    'primary',
                    'danger' => 'Arrêté',
                    'success' => 'Décret',
                    'warning' => 'Rapport',
                ])
                ->sortable(),

            TextColumn::make('domain')
                ->label('Domaine')
                ->badge()
                ->color('gray')
                ->toggleable(),

            TextColumn::make('gtt.name')
                ->label('GTT')
                ->placeholder('-')
                ->limit(20)
                ->toggleable(),

            TextColumn::make('published_at')
                ->label('Publié le')
                ->date('d/m/Y')
                ->sortable(),

            IconColumn::make('is_public')
                ->label('Public')
                ->boolean(),
        ];
    }

    public static function filters(): array
    {
        return [
            SelectFilter::make('type')
                ->options(Document::TYPES)
                ->label('Type'),

            SelectFilter::make('gtt')
                ->relationship('gtt', 'name')
                ->label('GTT'),
                
            SelectFilter::make('domain')
                ->options(array_combine(array_keys(Document::DOMAINS), array_keys(Document::DOMAINS)))
                ->label('Domaine'),
        ];
    }
}