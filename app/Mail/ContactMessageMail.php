<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    // On récupère les données envoyées par le contrôleur
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau message depuis PLUSS.CI : ' . $this->contactData['subject'],
            // On répond directement à l'adresse de la personne qui a écrit
            replyTo: [$this->contactData['email']], 
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact', // Le nom de notre vue
        );
    }
}