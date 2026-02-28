<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

// 👇 NOUVEAUX IMPORTS POUR LES FILTRES (Indispensables !)
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            // 1. Nom
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // 2. Sujet
                TextColumn::make('subject')
                    ->label('Sujet')
                    ->limit(30)
                    ->searchable(),

                // 3. Email
                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable(),

                // 4. Lu / Non lu
                IconColumn::make('is_read')
                    ->label('Lu')
                    ->boolean(),

                // 5. Date
                TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                //
            ])


            ->filters([

            // --- FILTRE 1 : STATUT (LU / NON LU) ---
                TernaryFilter::make('is_read')
                    ->label('Statut de lecture')
                    ->placeholder('Tous les messages')
                    ->trueLabel('Messages lus')
                    ->falseLabel('Messages non lus')
                    ->native(false), // Affiche un joli menu déroulant

                // --- FILTRE 2 : PAR DATE (DU ... AU ...) ---
                Filter::make('created_at')
                    ->label('Date de réception')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Du'),
                        DatePicker::make('created_until')
                            ->label('Au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
}
