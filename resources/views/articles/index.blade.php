<x-layout>
    {{--
        =============================================
        NOUVEAU BAND EAU D'EN-TÊTE (Style show.blade.php)
        =============================================
        J'utilise ici 'bg-blue-900' pour le bleu foncé.
        Si vous avez une couleur personnalisée dans tailwind.config.js (ex: 'bg-brand-blue'), remplacez-la.
    --}}
    <div class="bg-blue-900 py-16 text-white">
        <div class="container mx-auto px-4 relative">
            {{-- Petit badge au dessus du titre --}}
            <span class="inline-block bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded uppercase mb-4 tracking-wider">
                Actualités & Activités
            </span>
            {{-- Grand Titre --}}
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Toutes nos publications
            </h1>
            {{-- Sous-titre --}}
            <p class="text-blue-200 mt-4 text-lg max-w-2xl">
                Restez informé de toutes les actions menées par l'organisation PLUSS.CI.
            </p>
        </div>
    </div>

    {{-- =============================================
         SECTION CONTENU PRINCIPAL AVEC SIDEBAR
         ============================================= --}}
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                {{-- ================= SIDEBAR (FILTRES) ================= --}}
                <aside class="w-full lg:w-1/4 lg:sticky lg:top-24 self-start">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            Filtrer les archives
                        </h3>

                        <form action="{{ route('articles.index') }}" method="GET" class="space-y-5">
                            {{-- Filtre Année --}}
                            <div>
                                <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Année</label>
                                <select name="year" id="year" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 py-2.5">
                                    <option value="">Toutes les années</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filtre Mois --}}
                            <div>
                                <label for="month" class="block text-sm font-semibold text-gray-700 mb-2">Mois</label>
                                <select name="month" id="month" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 py-2.5">
                                    <option value="">Tous les mois</option>
                                    @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromDate(null, $m, 1)->locale('fr')->isoFormat('MMMM') }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Bouton Filtrer --}}
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg flex justify-center items-center gap-2">
                                Filtrer les résultats
                            </button>

                            {{-- Lien Reset si un filtre est actif --}}
                            @if(request()->has('year') || request()->has('month'))
                                <a href="{{ route('articles.index') }}" class="block text-center text-sm text-gray-500 hover:text-orange-500 underline mt-2">
                                    Réinitialiser les filtres
                                </a>
                            @endif
                        </form>
                    </div>
                </aside>

                {{-- ================= GRILLE DES ARTICLES ================= --}}
                <main class="w-full lg:w-3/4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($articles as $article)
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
                                
                                {{-- GESTION DE L'IMAGE (Correction des images cassées) --}}
                                <a href="{{ route('articles.show', $article->slug) }}" class="block relative h-52 overflow-hidden bg-gray-100">
                                    {{-- Badge Date en superposition --}}
                                    <div class="absolute top-4 right-4 bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg z-10 shadow-sm">
                                        {{ $article->created_at->format('d M Y') }}
                                    </div>

                                    @if($article->image_path && Storage::disk('public')->exists($article->image_path))
                                        {{-- Si l'image existe --}}
                                        <img src="{{ asset('storage/' . $article->image_path) }}" 
                                             alt="{{ $article->title }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        {{-- Fallback élégant si l'image n'existe pas --}}
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-blue-50 group-hover:bg-blue-100 transition-colors">
                                            {{-- Icône générique --}}
                                            <svg class="w-12 h-12 text-blue-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-blue-300 text-sm font-medium">PLUSS.CI</span>
                                        </div>
                                    @endif
                                </a>

                                {{-- Contenu de la carte --}}
                                <div class="p-6 flex flex-col flex-grow">
                                    {{-- Catégorie si disponible --}}
                                    @if($article->category)
                                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">{{ $article->category }}</span>
                                    @endif

                                    {{-- Titre --}}
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight line-clamp-2 group-hover:text-orange-500 transition-colors">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h3>

                                    {{-- Extrait (Résumé ou début du contenu) --}}
                                    <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-grow">
                                        {{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}
                                    </p>

                                    {{-- Lien Lire la suite --}}
                                    <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-orange-500 font-bold hover:text-orange-600 text-sm transition-all group-hover:gap-2">
                                        Lire la suite
                                        <svg class="w-4 h-4 ml-1 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white p-12 text-center rounded-xl shadow-sm border border-gray-100">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                <h3 class="text-xl font-medium text-gray-900">Aucun article trouvé</h3>
                                <p class="text-gray-500 mt-2">Essayez de modifier vos filtres de recherche.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-12">
                        {{ $articles->links() }}
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-layout>