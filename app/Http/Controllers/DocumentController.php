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
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', '%' . $q . '%')
                    ->orWhere('sub_domain', 'like', '%' . $q . '%')
                    ->orWhere('domain', 'like', '%' . $q . '%')
                    ->orWhere('type', 'like', '%' . $q . '%');
            });
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
        $documents = $query->orderBy('published_at', 'desc')->paginate(12)->withQueryString();

        // 4. Données pour les listes déroulantes
        $gtts = Gtt::orderBy('name')->get();
        $types = Document::TYPES;
        $domains = array_keys(Document::DOMAINS);

        return view('documents.index', compact('documents', 'gtts', 'types', 'domains'));
    }

    public function suggestions(Request $request)
    {
        $q = $request->get('q', '');
        if (strlen($q) < 2) {
            return response()->json([]);
        }
        $results = Document::where('is_public', true)
            ->where(function ($sub) use ($q) {
                $sub->where('title', 'like', '%' . $q . '%')
                    ->orWhere('type', 'like', '%' . $q . '%')
                    ->orWhere('domain', 'like', '%' . $q . '%');
            })
            ->orderBy('download_count', 'desc')
            ->limit(8)
            ->get(['id', 'title', 'type', 'domain'])
            ->map(fn($d) => [
                'title'  => $d->title,
                'type'   => $d->type,
                'domain' => $d->domain,
                'url'    => route('documents.index', ['search' => $d->title]),
            ]);
        return response()->json($results);
    }

    public function download(Document $document)
    {
        $document->increment('download_count');

        $fullPath = public_path('images/' . $document->file_path);

        if (!file_exists($fullPath)) {
            abort(404, 'Fichier introuvable');
        }

        return response()->download($fullPath, basename($document->file_path));
    }

    public function preview(Document $document)
    {
        $fullPath = public_path('images/' . $document->file_path);

        if (!file_exists($fullPath)) {
            abort(404, 'Fichier introuvable');
        }

        return response()->file($fullPath, ['Content-Type' => 'application/pdf']);
    }
}