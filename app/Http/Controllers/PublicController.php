<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Article;
use App\Models\Document;
use App\Models\Subscriber;
use App\Models\Poll;
use App\Models\Media;
use App\Models\Page;
use App\Models\Gtt; 
use App\Models\ContactMessage;
use App\Mail\WelcomeSubscriber;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\History;
use App\Models\Domaine;
use App\Models\Setting;

class PublicController extends Controller
{
    // ==========================================
    // PAGE D'ACCUEIL
    // ==========================================
    public function home()
    {
        // 1. Récupérer les 3 derniers articles publiés
        $latestArticles = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // 2. Récupérer les GTT actifs (4 au hasard)
        $featuredGtts = Gtt::where('is_published', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // 3. Récupérer les 3 derniers documents publics
        $latestDocuments = Document::where('is_public', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // 4. Statistiques pour la section "Chiffres clés"
        $stats = [
            'gtts' => Gtt::where('is_published', true)->count(),
            'articles' => Article::where('is_published', true)->count(),
            'documents' => Document::where('is_public', true)->count(),
        ];

        // 5. Récupérer les polls actifs
        $poll = Poll::where('is_active', true)->first();

        // 6. Récupérer les médias publics
        $medias = Media::where('is_public', true)->orderBy('published_at', 'desc')->get();

        // 7. Les 5 derniers articles pour le bandeau défilant
        $flashInfos = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Recupération des domaines d'activité
         $domaines = Domaine::where('est_actif', true)->orderBy('ordre')->get();    

        // 8. Affichage de l'historique
        $histories = History::where('is_active', true)
            ->orderBy('year', 'asc')
            ->get();

        // UN SEUL RETURN À LA FIN AVEC TOUTES LES VARIABLES
        return view('home', compact(
            'latestArticles', 
            'featuredGtts', 
            'latestDocuments', 
            'stats', 
            'poll', 
            'medias', 
            'flashInfos', 
            'histories',
            'domaines'
        ));
    }

    // ==========================================
    // ARTICLES (BLOG/ACTUALITÉS)
    // ==========================================
    
    // Liste des articles avec filtres (Année/Mois)
    public function index(Request $request) // Remplace "articles.index"
    {
        $query = Article::where('is_published', true);

        // Filtre par ANNEE
        if ($request->filled('year')) {
            $query->whereYear('published_at', $request->year); // Préférez published_at à created_at pour les articles
        }

        // Filtre par MOIS
        if ($request->filled('month')) {
            $query->whereMonth('published_at', $request->month);
        }

        // Pagination (9 par page)
        $articles = $query->orderBy('published_at', 'desc')->paginate(4);

        // Années disponibles pour le filtre
        $years = Article::selectRaw('YEAR(published_at) as year')
            ->where('is_published', true)
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('articles.index', compact('articles', 'years'));
    }

    // Afficher un article seul
    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail()
        ->where(function ($query) {
            // C'est un article normal OU c'est un évènement dont la date est DÉPASSÉE
            $query->where('is_event', false)
                  ->orWhere('event_date', '<', now());
        })
        ->orderBy('published_at', 'desc')
        ->paginate(9);
        return view('article', compact('article'));
    }

    // ==========================================
    // DOCUMENTS
    // ==========================================
    public function documents()
    {
        // On redirige vers le contrôleur dédié DocumentController si vous en avez un, 
        // sinon on affiche la vue simple ici.
        // Si vous utilisez DocumentController pour la logique de filtre avancée, 
        // cette méthode peut être supprimée ou rediriger.
        $documents = \App\Models\Document::orderBy('created_at', 'desc')->where('is_public', true)->paginate(9);
        return view('documents.index', compact('documents'));
        return to_route('documents.index'); 
    }

    // ==========================================
    // PAGES STATIQUES & PRÉSENTATION
    // ==========================================
    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('page', compact('page'));
    }

    public function biographie()
    {
        return view('presentation.biographie');
    }

    // ==========================================
    // MÉDIAS
    // ==========================================
    public function showMedia($slug)
    {
        $media = Media::where('slug', $slug)
            ->where('is_public', true)
            ->firstOrFail();

        return view('media-show', compact('media'));
    }

    // ==========================================
    // CONTACT
    // ==========================================
    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Enregistrement
        ContactMessage::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        // 3. Retour
        return back()->with('success', 'Merci ! Votre message a bien été envoyé.');
    }

    // ==========================================
    // NEWSLETTER
    // ==========================================
    public function subscribe(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // 2. Création
        $subscriber = Subscriber::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // 3. Envoi Email
        try {
            Mail::to($subscriber->email)->send(new WelcomeSubscriber($subscriber));
        } catch (\Exception $e) {
            // Log::error("Erreur mail: " . $e->getMessage());
        }

        return back()->with('success', 'Félicitations ' . $subscriber->name . ' ! Votre inscription est validée.');
    }

    public function unsubscribe(Subscriber $subscriber)
    {
        $subscriber->update(['unsubscribed_at' => now()]);
        return view('newsletter.unsubscribed');
    }

    // ==========================================
    // SONDAGES (VOTES)
    // ==========================================
    public function vote(Request $request)
    {
        $request->validate([
            'poll_id' => 'required|exists:polls,id',
            'option_index' => 'required|integer',
        ]);

        $poll = Poll::find($request->poll_id);
        $options = $poll->options;

        if (!isset($options[$request->option_index])) {
            return back()->with('error', 'Option invalide.');
        }

        if (!isset($options[$request->option_index]['votes'])) {
            $options[$request->option_index]['votes'] = 0;
        }
        
        $options[$request->option_index]['votes']++;

        $poll->options = $options;
        $poll->save();

        session()->put('has_voted_' . $poll->id, true);

        return back()->with('success', 'Vote enregistré !');
    }

    //Afficher l'équipe de la plateforme
    public function team()
{
    // On récupère les membres actifs, triés par ordre d'importance
    $members = TeamMember::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->get();

    // On les sépare en deux groupes pour l'affichage
    $secretariat = $members->where('department', 'Secrétariat Multisectoriel');
    $appui = $members->where('department', 'Équipe d\'appui');

    return view('pages.equipe', compact('secretariat', 'appui'));
}

    //Afficher les partenaires de la plateforme
    public function partners()
    {
        // On récupère les partenaires actifs, triés par ordre d'importance
        $partners = Partner::where('is_active', true)
                    ->orderBy('sort_order', 'asc')
                    ->paginate(6); // Pagination de 6 partenaires par page

        return view('pages.partenaires', compact('partners'));
    }

    //Le moteur des évènements
    public function events()
    {        // Récupérer les articles qui sont des événements (is_event = true) et publiés
        $events = Article::where('is_event', true)
            ->where('is_published', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc') // Trier par date de l'événement
            ->paginate(6); // Pagination de 6 événements par page
        return view('pages.evenements', compact('events'));
    }

    public function eventShow($id) // ou $slug
{
    $event = Article::where('is_event', 1)
                    ->where('is_published', 1)
                    ->where('id', $id) // ou where('slug', $slug)
                    ->firstOrFail();

    return view('pages.event-detail', compact('event'));
}

// Afficher la liste des zoonoses prioritaires
public function zoonoses()
{    $zoonoses = \App\Models\Zoonose::where('est_actif', true)
        ->orderBy('ordre', 'asc')
        ->get();
    return view('pages.zoonoses', compact('zoonoses'));
    $strategieDocument = Setting::get('strategie_document');
    return view('pages.zoonoses', compact('zoonoses', 'strategieDocument'));


}
}