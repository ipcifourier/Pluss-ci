<?php

/*use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';*/


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\GttController; 
use App\Http\Controllers\ArticleGttController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes - PLUSS CI
|--------------------------------------------------------------------------
|
| Ici se trouvent toutes les routes publiques de ton site.
|
*/

// ==========================================
// 1. PAGE D'ACCUEIL
// ==========================================
Route::get('/', [PublicController::class, 'home'])->name('home');


// ... après les routes documents/actualites ...

// ==========================================
// 5. PAGES DE PRÉSENTATION
// ==========================================
Route::prefix('presentation')->name('presentation.')->group(function () {
    
    // La route qui bloquait ton site :
    Route::get('/biographie', [PublicController::class, 'biographie'])->name('biographie');
    
    // J'ajoute celles-ci au cas où elles sont aussi dans ton menu :
    Route::get('/mot-du-coordonnateur', [PublicController::class, 'motDg'])->name('mot-dg');
    Route::get('/organigramme', [PublicController::class, 'organigramme'])->name('organigramme');
});


// ==========================================
// 2. SYSTÈME NEWSLETTER
// ==========================================

// L'action du formulaire d'inscription (POST)
Route::post('/subscribe', [PublicController::class, 'subscribe'])
    ->name('subscribe');

// Le lien de désinscription sécurisé (GET + Signature)
Route::get('/newsletter/unsubscribe/{subscriber}', [PublicController::class, 'unsubscribe'])
    ->name('unsubscribe')
    ->middleware('signed');


// ==========================================
// 3. PAGES DU PIED DE PAGE (Navigation)
// ==========================================
// Ces routes sont nécessaires car elles sont appelées dans ton footer (route('contact'), etc.)

Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Je mets des placeholders pour éviter les erreurs si tu n'as pas encore créé ces pages
Route::get('/documents', [PublicController::class, 'documents'])->name('documents');
Route::get('/actualites', [PublicController::class, 'actualites'])->name('actualites');


// ==========================================
// 6. BLOG / ACTUALITÉS
// ==========================================

// Route pour la liste de tous les articles avec filtres
Route::get('/actualites', [App\Http\Controllers\PublicController::class, 'index'])->name('articles.index');

// Ta route existante pour un article (ne change pas)
Route::get('/actualites/{article}', [App\Http\Controllers\PublicController::class, 'showArticle'])->name('article.show');

// Cette route permet d'afficher un article spécifique via son slug
Route::get('/actualites/{article}', [PublicController::class, 'showArticle'])
    ->name('article.show');

//Route pour afficher les articles d'une catégorie spécifique de  GTT
Route::get('/articles/{article:slug}', [ArticleGttController::class, 'show'])
    ->name('articles.show');

/*Route::get('/gtt/{gtt:slug}/actualites', [ArticleGttController::class, 'showGttArticles'])
    ->name('gtt.articles');*/

// ==========================================
// 7. INTERACTIVITÉ (Sondages)
// ==========================================
Route::post('/sondage/voter', [PublicController::class, 'vote'])
    ->name('poll.vote');
    
// ==========================================
// 8. PAGES DYNAMIQUES (Mentions légales, etc.)
// ==========================================
Route::get('/page/{slug}', [PublicController::class, 'showPage'])
    ->name('page.show');


// ...
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// 👇 AJOUTE CETTE LIGNE : C'est la route pour envoyer le formulaire
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');
// ...

// ... La route pour les gtt ...
// Route spécifique pour la page "Généralités sur les GTT" (doit être AVANT la route dynamique)
Route::get('/gtt/generalites-sur-les-gtt', [GttController::class, 'generalites'])->name('gtts.generalites');

//Route::get('/gtt/{slug}', [GttController::class, 'show'])->name('gtt.show');
Route::get('/gtt/{gtt:slug}', [GttController::class, 'show'])->name('gtt.show');
Route::get('/gtt/{gtt:slug}/actualites', [ArticleGttController::class, 'showGttArticles'])->name('gtt.articles');
Route::get('/gtt/{gtt:slug}/documents', [DocumentController::class, 'showGttDocuments'])->name('gtt.documents');
Route::get('/gtt/{gtt:slug}/evenements', [PublicController::class, 'showGttEvents'])->name('gtt.evenements');
Route::get('/gtt/{gtt:slug}/presentation', [PublicController::class, 'showGttPresentation'])->name('gtt.presentation');
Route::get('/gtt/{gtt:slug}/membres', [PublicController::class, 'showGttMembers'])->name('gtt.membres');
Route::get('/gtt/{gtt:slug}/publications', [PublicController::class, 'showGttPublications'])->name('gtt.publications');
Route::get('/gtt/{gtt:slug}/projets', [PublicController::class, 'showGttProjects'])->name('gtt.projets');
// Page qui liste tous les GTT
Route::get('/gtts', [GttController::class, 'index'])->name('gtts.index');
Route::get('/gtt/{gtt:slug}', [GttController::class, 'show'])->name('gtts.show');

// Page principale : Liste des documents avec filtres
Route::get('/documents', [DocumentController::class, 'index'])
    ->name('documents.index');

// Suggestions de recherche (autocomplete)
Route::get('/documents/suggestions', [DocumentController::class, 'suggestions'])
    ->name('documents.suggestions');

// Route pour télécharger un fichier (et compter le téléchargement)
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
    ->name('documents.download');

// Route pour prévisualiser un fichier dans le navigateur
Route::get('/documents/{document}/preview', [DocumentController::class, 'preview'])
    ->name('documents.preview');

//Route pour la barre de recherche
Route::get('/recherche', [SearchController::class, 'index'])->name('search');

// Espace Chercheurs
Route::get('/espace-chercheurs', function () {
    return view('chercheur');
})->name('espace.chercheurs');

// Route pour les pages dynamiques
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');

// Nouvelle route pour l'équipe
Route::get('/presentation/equipe', [PublicController::class, 'team'])->name('presentation.equipe');

// Nouvelle route pour les partenaires
Route::get('/presentation/partenaires', [PublicController::class, 'partners'])->name('presentation.partenaires');

//Route pour l'affichage des évènements
Route::get('/evenements', [PublicController::class, 'events'])->name('evenements');
Route::get('/evenements/{slug}', [App\Http\Controllers\PublicController::class, 'eventShow'])->name('evenements.show');

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');

//Route::get('/gtt/{gtt:slug}/actualites', [ArticleGttController::class, 'showGttArticles'])->name('gtt.articles');
Route::get('/gtt/{gtt:slug}/actualites', [ArticleGttController::class, 'showGttArticles'])->name('gtt.articles');
Route::get('/gtt/{gtt:slug}/documents', [DocumentController::class, 'showGttDocuments'])->name('gtt.documents');
Route::get('/gtt/{gtt:slug}/evenements', [PublicController::class, 'showGttEvents'])->name('gtt.evenements');
Route::get('/gtt/{gtt:slug}/presentation', [PublicController::class, 'showGttPresentation'])->name('gtt.presentation');

//Route pour afficher les commentaires d'un article
Route::post('/articles/{article}/comment', [CommentController::class, 'store'])->name('articles.comment');

//Route pour afficher les zoonoses prioritaires
Route::get('/zoonoses', [PublicController::class, 'zoonoses'])->name('zoonoses');
Route::get('/zoonoses/{slug}', [PublicController::class, 'showZoonose'])->name('zoonose.show');



// ==========================================
// 4. AUTHENTIFICATION (Breeze)
// ==========================================
// Si tu avais lancé l installation de Breeze juste avant, garde cette ligne.
// Sinon, tu peux la commenter.
require __DIR__.'/auth.php';