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

        // Vue dédiée pour le Mot de la Coordinatrice
        if ($slug === 'mot-de-la-coordonnatrice') {
            return view('presentation.mot-coordinatrice', compact('page'));
        }

        // Vue générique pour toutes les autres pages
        return view('pages.show', compact('page'));
    }
}
