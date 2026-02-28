<?php

namespace App\Filament\Resources\TeamMembers\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns as Columns;

class TeamMembersTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\ImageColumn::make('image_path')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                Columns\TextColumn::make('name')
                    ->label('Nom complet')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Columns\TextColumn::make('position')
                    ->label('Fonction')
                    ->searchable()
                    ->wrap(),

                Columns\TextColumn::make('department')
                    ->label('Pôle')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Secrétariat Multisectoriel' => 'warning',
                        'Équipe d\'appui' => 'success',
                        default => 'gray',
                    }),

                Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),

                Columns\ToggleColumn::make('is_active')
                    ->label('Visible'),
            ])
            ->defaultSort('sort_order', 'asc');
    }
}