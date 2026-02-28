<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|min:5',
        ]);

        $comment = $article->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'is_approved' => false, // Par défaut en attente
        ]);

        // Optionnel : envoyer une notification à l'admin

        return back()->with('success', 'Votre commentaire a été soumis et sera publié après validation.');
    }
}