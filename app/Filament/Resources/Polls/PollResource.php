<?php

namespace App\Filament\Resources\Polls;

use App\Filament\Resources\Polls\Pages;
use App\Filament\Resources\Polls\Schemas\PollForm;
use App\Filament\Resources\Polls\Tables\PollTable;
use App\Models\Poll;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Actions; 
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PollResource extends Resource
{
    protected static ?string $model = Poll::class;
    
    // Icône de graphique pour les sondages
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Schema $schema): Schema
    {
        return $schema->components(PollForm::schema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(PollTable::columns())
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPolls::route('/'),
            'create' => Pages\CreatePolls::route('/create'),
            'edit' => Pages\EditPolls::route('/{record}/edit'),
        ];
    }
}