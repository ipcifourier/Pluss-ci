<?php

namespace App\Http\Controllers;

use App\Models\Gtt;

class GttController extends Controller
{
    public function index()
    {
        // On récupère tous les GTT publiés
        $gtts = Gtt::where('is_published', true)->get();
        
        // On retourne la vue (qu'on a créée/va créer dans resources/views/gtts/index.blade.php)
        return view('gtts.index', compact('gtts'));
    }

    /**
     * Affiche un GTT spécifique.
     */
    public function show(Gtt $gtt)
    {
        // Vérification de sécurité : si le GTT n'est pas publié, on renvoie une 404
        /*if (!$gtt->is_published) {
            abort(404);
        }

        return view('gtts.show', compact('gtt'));*/

        // 1. Vérification : si le GTT n'est pas publié, on bloque l'accès (Erreur 404)
        if (!$gtt->is_published) {
            abort(404);
        }

        // 2. On récupère les 3 dernières actualités liées à CE groupe de travail
        // (On suppose que votre modèle Article a une colonne 'gtt_id')
        $relatedArticles = \App\Models\Article::where('gtt_id', $gtt->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // 3. On récupère les documents publics liés à CE groupe de travail
        // (On suppose que votre modèle Document a une colonne 'gtt_id')
        $relatedDocuments = \App\Models\Document::where('gtt_id', $gtt->id)
            ->where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 4. On envoie tout à la vue
        return view('gtts.show', compact('gtt', 'relatedArticles', 'relatedDocuments'));
    }
}
