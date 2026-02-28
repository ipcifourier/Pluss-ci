<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Schemas\Components\Grid;  
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;  
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Forms\Get;
use App\Models\Document;

class DocumentForm
{
    public static function schema(): array
    {
        return [
            Section::make('Document')
                ->schema([
                    TextInput::make('title')
                        ->label('Nom du document')
                        ->required()
                        ->maxLength(255),
                        
                    Select::make('type')
                        ->options(Document::TYPES)
                        ->required()
                        ->searchable(),
                        
                    Select::make('domain')
                        ->label('Domaine')
                        ->options(function () {
                            return collect(Document::DOMAINS)
                                ->keys()
                                ->mapWithKeys(fn ($key) => [$key => $key])
                                ->toArray();
                        })
                        ->live()
                        ->afterStateUpdated(fn ( $set) => $set('sub_domain', null)),
                        
                    Select::make('sub_domain')
                        ->label('Sous-domaine')
                        ->options(function ( $get) {
                            $domain = $get('domain');
                            if (!$domain) return [];
                            
                            return collect(Document::DOMAINS[$domain] ?? [])
                                ->mapWithKeys(fn ($item) => [$item => $item])
                                ->toArray();
                        })
                        ->visible(fn ( $get): bool => filled($get('domain'))),
                        
                    FileUpload::make('file_path')
                        ->label('Fichier')
                        ->directory('documents')
                        ->acceptedFileTypes(['application/pdf'])
                        ->required(),
                        
                    DatePicker::make('published_at')
                        ->label('Publié le')
                        ->default(now()),
                        
                    Toggle::make('is_public')
                        ->label('Public')
                        ->default(true),
                        
                    Select::make('gtt_id')
                        ->relationship('gtt', 'name')
                        ->label('GTT')
                        ->searchable()
                        ->preload(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ];
    }
}