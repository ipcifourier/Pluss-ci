<?php

namespace App\Filament\Resources\Documents;

use App\Filament\Resources\Documents\Pages;
use App\Filament\Resources\Documents\Schemas\DocumentForm;
use App\Filament\Resources\Documents\Tables\DocumentTable;
use App\Models\Document;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Schemas\Schema; // ← IMPORTANT : Importer Schema au lieu de Form

class DocumentResource extends Resource
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-folder';
    protected static \UnitEnum|string|null $navigationGroup = 'Gestion des documents';
    protected static ?string $navigationLabel = 'Documents';

    // CORRECTION : Utiliser Schema au lieu de Form
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema(DocumentForm::schema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(DocumentTable::columns())
            ->filters(DocumentTable::filters())
            ->actions([
                //EditAction::make(),
                //DeleteAction::make(),
            ])
            ->bulkActions([
                //BulkActionGroup::make([
                //DeleteBulkAction::make(),
                
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}