<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage; // N'oublie pas d'importer le modèle pour sauvegarder les messages dans la base de données

class ContactController extends Controller
{
    public function store(Request $request)
{
    // 1. Validation des champs
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // 2. Sauvegarde dans la base de données (pour le voir dans Filament)
    ContactMessage::create($validatedData);

    // 3. LA MAGIE : Envoi de l'e-mail à la coordonnatrice ou l'équipe technique
    Mail::to('secretariat@pluss.ci')->send(new ContactMessageMail($validatedData));

    // 4. Redirection avec un message de succès
    return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
}
    //
}
