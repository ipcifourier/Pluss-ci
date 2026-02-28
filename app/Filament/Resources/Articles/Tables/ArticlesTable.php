<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Tables;

class ArticlesTable
{
    public static function columns(): array
    {
        return [
            Tables\Columns\ImageColumn::make('image_path')
                ->label('Image')
                ->circular(), // Optionnel : rend l'image ronde
            
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable() // Barre de recherche
                ->sortable()   // Triable au clic
                ->limit(50),   // Coupe si trop long

            Tables\Columns\IconColumn::make('is_published')
                ->label('Publié')
                ->boolean(),   // Affiche une coche verte ou une croix rouge

            Tables\Columns\TextColumn::make('published_at')
                ->label('Date')
                ->date('d/m/Y') // Format français
                ->sortable(),
        ];
    }
}

/*namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('image_path'),
                IconColumn::make('is_published')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}*/
