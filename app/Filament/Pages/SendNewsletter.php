<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
// --- CHANGEMENT MAJEUR ICI : ON IMPORTE SCHEMA, PAS FORM ---
use Filament\Schemas\Schema; 
// ----------------------------------------------------------
use Filament\Schemas\Components as Layouts; 
use Filament\Forms\Components as Fields; 
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscriber;

class SendNewsletter extends Page implements HasForms
{
    use InteractsWithForms;

    // Configuration stricte (On garde ce qui marche)
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paper-airplane';
    protected static string | \UnitEnum | null $navigationGroup = 'Communication';
    protected static ?string $navigationLabel = 'Envoyer Newsletter';
    protected string $view = 'filament.pages.send-newsletter';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    
    // On accepte Schema $schema (ce que Laravel envoie) au lieu de Form $form
    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Layouts\Section::make('Rédaction du Bulletin')
                    ->description('Cet email sera envoyé à tous les abonnés actifs.')
                    ->schema([
                        Fields\TextInput::make('subject')
                            ->label('Sujet de l\'email')
                            ->required(),
                            
                        Fields\RichEditor::make('content')
                            ->label('Contenu')
                            ->required(),
                    ])
            ])
            ->statePath('data');
    } 

    public function send()
    {
        $data = $this->form->getState();
        
        $subscribers = Subscriber::whereNull('unsubscribed_at')->get();

        if ($subscribers->isEmpty()) {
            Notification::make()->title('Aucun abonné actif.')->warning()->send();
            return;
        }

        foreach ($subscribers as $subscriber) {
            Mail::raw(strip_tags($data['content']), function ($message) use ($subscriber, $data) {
                $message->to($subscriber->email)
                        ->subject($data['subject']);
            });
        }

        Notification::make()
            ->title('Newsletter envoyée avec succès !')
            ->body('Envoyée à ' . $subscribers->count() . ' abonnés.')
            ->success()
            ->send();

        $this->form->fill();
    }
}