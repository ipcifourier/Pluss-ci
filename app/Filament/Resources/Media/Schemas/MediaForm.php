<?php

namespace App\Filament\Resources\Media\Schemas;

// On retire l'import "Get" qui posait problème
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Choix du Type
                Select::make('type')
                    ->label('Type de Média')
                    ->options([
                        'audio' => 'Podcast Audio (MP3)',
                        'video' => 'Vidéo (YouTube)',
                        'album' => 'Album Photos',
                    ])
                    ->default('video')
                    ->required()
                    ->live(), // Rend le formulaire réactif

                // 2. Titre & Slug
                TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(fn ($operation, $state, $set) => 
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                TextInput::make('slug')->required()->unique(ignoreRecord: true),

                // 3. Image (Toujours visible)
                FileUpload::make('cover_image')
                    ->label('Image de couverture')
                    ->image()
                    ->directory('media-covers')
                    ->required()
                    ->columnSpanFull(),

                // 4. Audio (Visible si type == audio)
                FileUpload::make('audio_file')
                    ->label('Fichier Audio (MP3)')
                    ->disk('public')
                    ->directory('podcasts')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/x-m4a'])
                    // 👇 CORRECTION ICI : "fn ($get)" au lieu de "fn (Get $get)"
                    ->visible(fn ($get) => $get('type') === 'audio')
                    ->columnSpanFull(),

                // 5. Vidéo (Visible si type == video)
                TextInput::make('video_url')
                    ->label('Lien YouTube')
                    ->url()
                    // 👇 CORRECTION ICI
                    ->visible(fn ($get) => $get('type') === 'video')
                    ->columnSpanFull(),

                // 6. Album (Visible si type == album)
                FileUpload::make('gallery_images')
                    ->label('Galerie Photos')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->directory('albums-gallery')
                    // 👇 CORRECTION ICI
                    ->visible(fn ($get) => $get('type') === 'album')
                    ->columnSpanFull(),

                // 7. Infos communes
                Textarea::make('description')->rows(3)->columnSpanFull(),
                DatePicker::make('published_at')->label('Date de publication')->default(now()),
                Toggle::make('is_public')->label('Visible sur le site')->default(true),
            ]);
    }
}