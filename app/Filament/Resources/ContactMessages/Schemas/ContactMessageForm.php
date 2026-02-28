<?php

/*namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}*/


/*namespace App\Filament\Resources\ContactMessages\Schemas;

// 👇 CES IMPORTATIONS SONT INDISPENSABLES !
use Filament\Forms\Components\Section;    // <--- C'est celle-ci qui manquait !
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema; // Si tu utilises un Schema personnalisé

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // Maintenant PHP reconnait "Section" grâce au "use" en haut
                Section::make('Détails du message')
                ->description('Informations envoyées depuis le formulaire de contact')
                ->schema([
                    
                    // 1. Nom complet
                    TextInput::make('name')
                        ->label('Nom complet')
                        ->disabled(),

                    // 2. Email
                    TextInput::make('email')
                        ->label('Adresse E-mail')
                        ->prefixIcon('heroicon-m-envelope')
                        ->disabled(),

                    // 3. Sujet
                    TextInput::make('subject')
                        ->label('Sujet du message')
                        ->columnSpanFull()
                        ->disabled(),

                    // 4. Message (Important : le nom 'message' doit correspondre à ta BDD)
                    Textarea::make('message')
                        ->label('Contenu du message')
                        ->columnSpanFull()
                        ->rows(5)
                        ->disabled(),

                    // 5. Statut
                    Toggle::make('is_read')
                        ->label('Marquer comme lu')
                        ->onColor('success')
                        ->offColor('danger'),
                ])
                ->columns(2),
        ]);
    }
}*/

namespace App\Filament\Resources\ContactMessages\Schemas;

/*use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Illuminate\View\Concerns\ManagesLayouts;
use Filament\Schemas\Schema;
use App\Filament\Resources\ContactMessages\Schemas\Layouts\Section;*/
use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;

class ContactMessageForm
{
    public static function schema(): array
    {
        return [
            Layouts\Section::make('Informations du message')
                ->description('Détails du message de contact')
                ->schema([
                    TextInput::make('name')
                        ->label('Nom')
                        ->required()
                        ->maxLength(255),
                    
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    
                    TextInput::make('subject')
                        ->label('Sujet')
                        ->required()
                        ->maxLength(255),
                    
                    Textarea::make('message')
                        ->label('Message')
                        ->required()
                        ->rows(5)
                        ->columnSpanFull(),
                    
                    Select::make('status')
                        ->label('Statut')
                        ->options([
                            'new' => 'Nouveau',
                            'read' => 'Lu',
                            'replied' => 'Répondu',
                            'archived' => 'Archivé',
                        ])
                        ->default('new'),
                    
                    DateTimePicker::make('created_at')
                        ->label('Reçu le')
                        ->disabled()
                        ->displayFormat('d/m/Y H:i'),
                ])
                ->columns(2),
        ];
    }
}