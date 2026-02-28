<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleGttController extends Controller
{
    public function show(Article $article): View
    {
        
    // On ajoute ->load('gtt') pour charger la relation
    $article->load('gtt');
    // On vérifie que l'article est bien publié, sinon 404
        abort_if(! $article->is_published, 404);

        return view('articles.show', compact('article'));
    }
}