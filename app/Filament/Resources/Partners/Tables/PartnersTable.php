<?php

namespace App\Filament\Resources\Partners\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns as Columns;

class PartnersTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->square(),

                Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Columns\TextColumn::make('website_url')
                    ->label('Site web')
                    ->limit(30)
                    ->color('primary'),

                Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),

                Columns\ToggleColumn::make('is_active')
                    ->label('Visible'),
            ])
            ->defaultSort('sort_order', 'asc');
    }
}