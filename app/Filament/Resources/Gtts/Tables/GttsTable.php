<?php


namespace App\Filament\Resources\Gtts\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

use Filament\Forms\Components\DatePicker;

use Illuminate\Database\Eloquent\Builder;

class GttsTable
{
    /*
    |--------------------------------------------------------------------------
    | COLUMNS
    |--------------------------------------------------------------------------
    */
    public static function columns(): array
    {
        return [

            ImageColumn::make('logo')
                ->disk('public')
                ->circular()
                ->size(40),

            TextColumn::make('name')
                ->label('Nom')
                ->searchable()
                ->sortable(),

            TextColumn::make('slug')
                ->copyable()
                ->toggleable(),

            // leader = STRING simple (pas relation)
            TextColumn::make('leader')
                ->label('Responsable')
                ->searchable(),

            TextColumn::make('short_description')
                ->limit(40),

            // ✅ bool → icône
            IconColumn::make('is_published')
                ->boolean()
                ->label('Publié'),

            TextColumn::make('created_at')
                ->dateTime('d/m/Y H:i'),

            TextColumn::make('updated_at')
                ->since(),
            
            BadgeColumn::make('status')
               ->colors([
                'success' => fn ($state) => $state === 'active',
                'danger' => fn ($state) => $state === 'inactive',
                'warning' => fn ($state) => $state === 'pending',
    ])
        ];
        
    }

    /*
    |--------------------------------------------------------------------------
    | FILTERS (UNIQUEMENT DES FILTERS)
    |--------------------------------------------------------------------------
    */
    public static function filters(): array
    {
        return [

            SelectFilter::make('is_published')
                ->label('Publié')
                ->options([
                    1 => 'Oui',
                    0 => 'Non',
                ]),

            Filter::make('created_at')
                ->form([
                    DatePicker::make('from'),
                    DatePicker::make('until'),
                ])
                ->query(function (Builder $query, array $data) {
                    return $query
                        ->when($data['from'], fn ($q) =>
                            $q->whereDate('created_at', '>=', $data['from']))
                        ->when($data['until'], fn ($q) =>
                            $q->whereDate('created_at', '<=', $data['until']));
                }),
        ];
    }
}