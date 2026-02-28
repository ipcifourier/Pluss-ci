<?php

/*namespace App\Filament\Resources\Subscribers;

use App\Filament\Resources\Subscribers\Pages;
use App\Filament\Resources\Subscribers\Schemas\SubscriberForm;
use App\Filament\Resources\Subscribers\Tables\SubscriberTable;
use App\Models\Subscriber;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;
    
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-envelope';

    public static function form(Schema $schema): Schema
    {
        return $schema->components(SubscriberForm::schema());
    }

    public static function table(Table $table): Table
    {
        return $table
            

            ->columns(SubscriberTable::columns())
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
            'index' => Pages\ListSubscribers::route('/'),
            'create' => Pages\CreateSubscriber::route('/create'),
            'edit' => Pages\EditSubscriber::route('/{record}/edit'),
        ];
    }
}*/


namespace App\Filament\Resources\Subscribers;

use App\Filament\Resources\Subscribers\Pages;
use App\Models\Subscriber;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // On garde Schema qui fonctionne chez toi
use Filament\Tables;
use Filament\Tables\Table;

class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static \UnitEnum | string | null $navigationGroup = 'Abonnés et Contacts';
    protected static ?string $navigationLabel = 'Abonnés Newsletter';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // On utilise la syntaxe la plus simple possible
            \Filament\Forms\Components\TextInput::make('name')
                ->label('Nom complet')
                ->required(),

            \Filament\Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
                
            \Filament\Forms\Components\DateTimePicker::make('unsubscribed_at')
                ->label('Désinscription')
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. LE NOM (Ton objectif principal)
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->weight('bold'),

                // 2. L'EMAIL
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope'),

                // 3. LA DATE
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->label('Inscrit le'),
            ])
            // ⚠️ J'ai vidé les actions pour l'instant. 
            // Si la page charge, on saura que le problème venait bien des boutons Edit/Delete.
            ->actions([
                // On réactivera ça après !
            ])
            ->bulkActions([
                // On réactivera ça après !
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscribers::route('/'),
            'create' => Pages\CreateSubscriber::route('/create'),
            'edit' => Pages\EditSubscriber::route('/{record}/edit'),
        ];
    }
}