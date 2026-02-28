<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Gtt;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        // 1. Base de la requête
        $query = Document::where('is_public', true);

        // 2. Application des filtres
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        if ($request->filled('gtt')) {
            $query->where('gtt_id', $request->gtt);
        }

        // 3. Tri et Pagination
        $documents = $query->orderBy('published_at', 'desc')->paginate(12);

        // 4. Données pour les listes déroulantes
        $gtts = Gtt::orderBy('name')->get();
        $types = Document::TYPES;
        $domains = array_keys(Document::DOMAINS);

        return view('documents.index', compact('documents', 'gtts', 'types', 'domains'));
    }

    public function download(Document $document)
    {
        // Incrémente le compteur et télécharge
        $document->increment('download_count');
        
        // Vérifie si le fichier existe
        if (!file_exists(storage_path('app/public/' . $document->file_path))) {
            abort(404, 'Fichier introuvable');
        }

        return response()->download(storage_path('app/public/' . $document->file_path));
    }
}