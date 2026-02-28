<?php

namespace App\Filament\Resources\Zoonoses;

use App\Filament\Resources\Zoonoses\Pages\CreateZoonose;
use App\Filament\Resources\Zoonoses\Pages\EditZoonose;
use App\Filament\Resources\Zoonoses\Pages\ListZoonoses;
use App\Filament\Resources\Zoonoses\Schemas\ZoonoseForm;
use App\Filament\Resources\Zoonoses\Tables\ZoonosesTable;
use App\Models\Zoonose;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ZoonoseResource extends Resource
{
    protected static ?string $model = Zoonose::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'zoonose';

    public static function form(Schema $schema): Schema
    {
        return ZoonoseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZoonosesTable::configure($table);
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
            'index' => ListZoonoses::route('/'),
            'create' => CreateZoonose::route('/create'),
            'edit' => EditZoonose::route('/{record}/edit'),
        ];
    }
}
