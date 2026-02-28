<?php

namespace App\Filament\Resources\Domaines;

use App\Filament\Resources\Domaines\Pages\CreateDomaine;
use App\Filament\Resources\Domaines\Pages\EditDomaine;
use App\Filament\Resources\Domaines\Pages\ListDomaines;
use App\Filament\Resources\Domaines\Schemas\DomaineForm;
use App\Filament\Resources\Domaines\Tables\DomainesTable;
use App\Models\Domaine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DomaineResource extends Resource
{
    protected static ?string $model = Domaine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'domaine';

    public static function form(Schema $schema): Schema
    {
        return DomaineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DomainesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDomaines::route('/'),
            'create' => CreateDomaine::route('/create'),
            'edit' => EditDomaine::route('/{record}/edit'),
        ];
    }
}
