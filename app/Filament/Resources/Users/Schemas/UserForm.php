<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema; // <-- Très important pour correspondre à votre UserResource
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    // On crée la méthode "make" exactement comme l'attend UserResource
    public static function make(Schema $schema): Schema
    {
        return $schema->schema([
            
            // 1. Champ Nom
            TextInput::make('name')
                ->label('Nom complet')
                ->required()
                ->maxLength(255),
                
            // 2. Champ Email
            TextInput::make('email')
                ->label('Adresse e-mail')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
                
            // 3. Champ Mot de passe
            TextInput::make('password')
                ->label('Mot de passe')
                ->password()
                ->revealable()
                ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state)),
                
            // 4. Champ Rôles et Permissions (Shield)
            Select::make('roles')
                ->label('Rôles et Permissions')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload()
                ->searchable()
                ->columnSpanFull(),
        ]);
    }
}