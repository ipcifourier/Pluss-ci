<?php

namespace App\Filament\Resources\Articles\Schemas;

// 1. Layouts (Structure visuelle)
use Filament\Schemas\Components as Layouts;

// 2. Fields (Champs de saisie)
use Filament\Forms\Components as Fields; 

use Illuminate\Support\Str;

// --- CORRECTION ICI ---
// On utilise le Set des Formulaires, pas des Schemas
use Filament\Forms\Set; 
use Filament\Forms\Get; // (Optionnel, utile si tu en as besoin plus tard)

class ArticleForm
{
    public static function schema(): array
    {
        return [
            // UTILISATION DE 'Layouts' pour la Section (qui vient de Schemas)
            Layouts\Section::make('Détails de l\'article')
                ->schema([
                    
                    // UTILISATION DE 'Fields' pour les champs (qui viennent de Forms)
                    Fields\TextInput::make('title') // Assure-toi que c'est bien TextInput ou Text selon ce qui a marché
                    ->label('Titre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
    // On retire le typage strict de $operation pour éviter les erreurs d'injection
    ->afterStateUpdated(fn ($state, $set, string $operation = 'create') => 
        ($operation === 'create') ? $set('slug', Str::slug($state)) : null
    ),

                    Fields\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->disabled()
                        ->dehydrated(),

                    Fields\FileUpload::make('image_path')
                        ->label('Image de couverture')
                        ->image()
                        ->directory('articles')
                        ->disk('public')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->columnSpanFull(),

                    Fields\RichEditor::make('content')
                        ->label('Contenu')
                        ->required()
                        ->columnSpanFull(),

                ])->columns(2),

            Layouts\Section::make('Publication')
                ->schema([
                    Fields\Toggle::make('is_published')
                        ->label('Publié ?')
                        ->default(false),

                    Fields\DatePicker::make('published_at')
                        ->label('Date de publication')
                        ->default(now()),
                ])->columns(2),

            Layouts\Section::make('Événement (optionnel)')
                ->schema([
                    Fields\Toggle::make('is_event')
                        ->label('C\'est un événement ?')
                        ->live()
                        ->default(false),
                    Fields\DatePicker::make('event_date')
                        ->label('Date de l\'événement')
                        ->required(fn ( $get) => $get('is_event')) // Obligatoire seulement si le toggle est activé
                        ->visible(fn ( $get) => $get('is_event')), // Visible seulement si activé
                        
                    Fields\TextInput::make('event_location')
                        ->label('Lieu de l\'événement')
                        ->required(fn ( $get) => $get('is_event')) // Obligatoire seulement si le toggle est activé
                        ->visible(fn ($get) => $get('is_event')),
                ])->columns(2),
        ];
    }
}


