<?php

namespace App\Filament\Resources\Gtts;

use App\Models\Gtt;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

use App\Filament\Resources\Gtts\Schemas\GttForm;
use App\Filament\Resources\Gtts\Tables\GttsTable;

use App\Filament\Resources\Gtts\Pages;

class GttResource extends Resource
{
    protected static ?string $model = Gtt::class;

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */
   protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'GTT';
    protected static \UnitEnum|string|null $navigationGroup = 'Gestion des GTT';
    protected static ?string $recordTitleAttribute = 'gtt';
    protected static ?int $navigationSort = 1;

    //protected static ?string $recordTitleAttribute = 'name';


    /*
    |--------------------------------------------------------------------------
    | FORM (Filament v5 → Schema uniquement)
    |--------------------------------------------------------------------------
    */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema(GttForm::schema());
    }


    /*
    |--------------------------------------------------------------------------
    | TABLE (externalisée dans GttsTable)
    |--------------------------------------------------------------------------
    */
    public static function table(Table $table): Table
    {
        return $table
            ->columns(GttsTable::columns())
            ->filters(GttsTable::filters())
            //->actions(GttsTable::actions())
            ///->bulkActions(GttsTable::bulkActions())
            ->defaultSort('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    | FILTERS (⚠️ UNIQUEMENT DES FILTERS)
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
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS (pour plus tard)
    |--------------------------------------------------------------------------
    */
    public static function getRelations(): array
    {
        return [
            //
            // On connecte le manager ici
        RelationManagers\ArticlesRelationManager::class,
        ];
    }

    

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGtts::route('/'),
            'create' => Pages\CreateGtt::route('/create'),
            //'view' => Pages\ViewGtt::route('/{record}'),
            'edit' => Pages\EditGtt::route('/{record}/edit'),
        ];
    }
}