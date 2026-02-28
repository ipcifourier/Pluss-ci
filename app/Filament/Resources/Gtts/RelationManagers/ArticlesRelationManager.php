<?php

namespace App\Filament\Resources\Gtts\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions\BulkAction;
use Filament\Forms\Set;
//use Filament\Schemas\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    public function form(Schema $schema): Schema
    {
       /* return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }*/

        return $schema
        ->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $operation, $state, $set) {
                    if ($operation === 'create') {
                        $set('slug', Str::slug($state));
                    }
                }),

            Forms\Components\TextInput::make('slug')
                ->disabled()
                ->dehydrated() // La ligne importante pour le fix
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\FileUpload::make('image_path')
                ->image()
                ->directory('articles')
                ->label('Image de couverture'),

            Forms\Components\RichEditor::make('content')
                ->label('Contenu')
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_published')
                ->label('Publié')
                ->default(true),
        ]);
}    

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
