<?php

namespace App\Http\Controllers;
use App\Models\Page; // importation du modèle Page
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        // On cherche la page qui a ce slug précis, sinon on renvoie une 404
        $page = Page::where('slug', $slug)->firstOrFail();

        // On renvoie la vue qu'on a créée tout à l'heure avec la condition "Mot"
        return view('pages.show', compact('page'));
        
    }
}
