<?php

namespace App\Filament\Resources\Articles;

use App\Filament\Resources\Articles\Pages;
use App\Filament\Resources\Articles\Schemas\ArticleForm;
use App\Filament\Resources\Articles\Tables\ArticlesTable;
use App\Models\Article;
use Filament\Schemas\Schema; 
use Filament\Resources\Resource;
use Filament\Tables\Table;

// --- LA CORRECTION EST ICI ---
// Dans ta version, toutes les actions viennent de "Filament\Actions"
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static string|\UnitEnum|null $navigationGroup = 'Actualités';

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ArticleForm::schema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(ArticlesTable::columns())
            ->filters([
                // Tu pourras ajouter des filtres ici (ex: par date, par statut)

                // On garde les filtres vides pour l'instant pour sécuriser l'affichage
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // On utilise les classes importées en haut (sans le préfixe Tables\)
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}

