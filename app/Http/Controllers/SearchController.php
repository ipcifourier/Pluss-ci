<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Gtt;
use App\Models\Document;

class SearchController extends BaseController
{
    public function index(Request $request)
    {
        // On récupère le mot-clé tapé dans l'URL (?q=mot-clé)
        $q = $request->input('q');

        // Si la barre est vide, on renvoie des résultats vides
        if (!$q) {
            return view('search.index', [
                'query' => $q,
                'articles' => collect(),
                'gtts' => collect(),
                'documents' => collect(),
            ]);
        }

        // 1. Recherche dans les Actualités (Titre ou Contenu)
        $articles = Article::where('is_published', true)
            ->where(function ($queryBuilder) use ($q) {
                $queryBuilder->where('title', 'LIKE', "%{$q}%")
                             ->orWhere('content', 'LIKE', "%{$q}%");
            })
            ->latest('published_at')
            ->get();

        // 2. Recherche dans les GTT (Nom ou Description)
        $gtts = Gtt::where('is_published', true)
            ->where(function ($queryBuilder) use ($q) {
                $queryBuilder->where('name', 'LIKE', "%{$q}%")
                             ->orWhere('description', 'LIKE', "%{$q}%");
            })
            ->get();

        // 3. Recherche dans la Bibliothèque/Documents (Titre)
        $documents = Document::where('is_public', true)
            ->where('title', 'LIKE', "%{$q}%")
            ->latest('created_at')
            ->get();

        return view('search.index', compact('q', 'articles', 'gtts', 'documents'));
    }
}