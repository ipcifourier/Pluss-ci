<?php





namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor; // On tente le RichEditor
use Filament\Forms\Components\Textarea;   // Au cas où, on garde Textarea
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. TITRE
                /*TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($operation, $state, $set) => 
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),*/

                // 1. TITRE
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            // Mise à jour après 500ms d'inactivité (plus visible que onBlur)
                            ->live(debounce: 500) 
                            ->afterStateUpdated(function ($operation, $state, $set) {
                                // Si on est en création, on met à jour le slug
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),    

                // 2. SLUG
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                // 3. IMAGE
                FileUpload::make('image')
                    ->label('Image de couverture')
                    ->image()
                    ->directory('pages-covers')
                    ->columnSpanFull(),

                // 4. CONTENU
                // Si RichEditor plante, remplace "RichEditor" par "Textarea" ci-dessous
                RichEditor::make('content') 
                    ->label('Contenu')
                    ->required()
                    ->columnSpanFull(),

                // 5. PUBLIÉ
                Toggle::make('is_published')
                    ->label('Publié')
                    ->default(true),
            ]);
    }
}
