<?php

/*namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class WelcomeSubscriber extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $unsubscribeUrl;

    // On demande un Abonnés (Subscriber) lors de la création de l'email
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
        
        // On génère le lien sécurisé de désinscription ici
        $this->unsubscribeUrl = URL::signedRoute('unsubscribe', ['subscriber' => $subscriber->id]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur Une Seule Santé Côte d\'Ivoire', // Le sujet du mail
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome', // On va créer ce fichier juste après
        );
    }
}*/


namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class WelcomeSubscriber extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $unsubscribeUrl;

    // On reçoit l'abonné au moment de créer le mail
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;

        // On génère le lien sécurisé de désinscription
        $this->unsubscribeUrl = URL::signedRoute('unsubscribe', ['subscriber' => $subscriber->id]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur la plateforme Une Seule Santé CI', // Le titre du mail
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome', // Le fichier HTML qu'on va créer juste après
        );
    }
}