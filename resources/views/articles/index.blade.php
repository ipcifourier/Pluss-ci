<x-layout>
    {{-- BANNIÈRE (style Centre de Documentation) --}}
    <section class="bg-brand-green text-white pt-12 pb-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Actualités & Publications</h1>
            <p class="opacity-90 text-lg max-w-2xl mx-auto mb-8">
                Restez informé de toutes les actions et publications de la plateforme Une Seule Santé.
            </p>

            {{-- Barre de recherche --}}
            <form action="{{ route('articles.index') }}" method="GET" class="relative max-w-2xl mx-auto flex">
                @if(request('year')) <input type="hidden" name="year" value="{{ request('year') }}"> @endif
                @if(request('month')) <input type="hidden" name="month" value="{{ request('month') }}"> @endif
                <div class="relative flex-1">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Rechercher un article, une publication…"
                        class="w-full pl-12 pr-4 py-4 text-gray-800 bg-white rounded-l-xl text-base focus:outline-none focus:ring-2 focus:ring-brand-orange">
                </div>
                <button type="submit"
                    class="px-6 py-4 bg-brand-orange hover:bg-orange-600 text-white font-bold text-sm rounded-r-xl transition whitespace-nowrap">
                    Rechercher
                </button>
            </form>
        </div>
    </section>

    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">

            {{-- BARRE DE FILTRES --}}
            <div class="max-w-7xl mx-auto mb-8">
                <form action="{{ route('articles.index') }}" method="GET"
                    class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">

                    @if(request('search'))
                        <div class="mb-4 flex items-center gap-2">
                            <span class="text-sm text-gray-500">Recherche :</span>
                            <span class="inline-flex items-center gap-1.5 bg-brand-green/10 text-brand-green text-sm font-semibold px-3 py-1 rounded-full">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
                                "{{ request('search') }}"
                            </span>
                        </div>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                        {{-- Filtre Année --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Année</label>
                            <select name="year"
                                class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-green focus:border-brand-green"
                                onchange="this.form.submit()">
                                <option value="">Toutes les années</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Filtre Mois --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Mois</label>
                            <select name="month"
                                class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-green focus:border-brand-green"
                                onchange="this.form.submit()">
                                <option value="">Tous les mois</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromDate(null, $m, 1)->locale('fr')->isoFormat('MMMM') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Boutons reset --}}
                        <div class="flex gap-2">
                            <button type="submit"
                                class="flex-1 bg-brand-green hover:bg-green-700 text-white font-bold py-2 rounded-lg transition text-sm">
                                Filtrer
                            </button>
                            @if(request()->hasAny(['year', 'month', 'search']))
                                <a href="{{ route('articles.index') }}"
                                    class="flex items-center justify-center px-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-sm font-medium transition" title="Réinitialiser">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            {{-- Compteur --}}
            <div class="max-w-7xl mx-auto mb-5">
                <p class="text-sm text-gray-500">
                    Affichage de <span class="font-semibold text-gray-700">{{ $articles->firstItem() ?? 0 }}</span>
                    à <span class="font-semibold text-gray-700">{{ $articles->lastItem() ?? 0 }}</span>
                    sur <span class="font-semibold text-gray-700">{{ $articles->total() }}</span> article(s)
                </p>
            </div>

            {{-- GRILLE DES ARTICLES --}}
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($articles as $article)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">

                            <a href="{{ route('articles.show', $article->slug) }}"
                                class="block relative h-52 overflow-hidden bg-gray-100">
                                <div class="absolute top-4 right-4 bg-brand-orange text-white text-xs font-bold px-3 py-1.5 rounded-lg z-10 shadow-sm">
                                    {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : $article->created_at->format('d M Y') }}
                                </div>

                                @if($article->image_path && Storage::disk('public')->exists($article->image_path))
                                    <img src="{{ asset('images/' . $article->image_path) }}"
                                        alt="{{ $article->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-green-50 group-hover:bg-green-100 transition-colors">
                                        <svg class="w-12 h-12 text-brand-green/30 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                        <span class="text-brand-green/40 text-sm font-medium">PLUSS.CI</span>
                                    </div>
                                @endif
                            </a>

                            <div class="p-5 flex flex-col flex-grow">
                                @if($article->category)
                                    <span class="text-xs font-bold text-brand-green uppercase tracking-wider mb-2">{{ $article->category }}</span>
                                @endif

                                <h3 class="text-base font-bold text-gray-900 mb-3 leading-snug line-clamp-2 group-hover:text-brand-orange transition-colors">
                                    <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>

                                <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-grow">
                                    {{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}
                                </p>

                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="inline-flex items-center text-brand-orange font-bold hover:text-orange-600 text-sm transition-all">
                                    Lire la suite
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white p-12 text-center rounded-xl shadow-sm border border-gray-100">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <h3 class="text-xl font-medium text-gray-900">Aucun article trouvé</h3>
                            <p class="text-gray-500 mt-2">Essayez de modifier vos filtres de recherche.</p>
                            <a href="{{ route('articles.index') }}" class="mt-4 inline-block text-brand-green hover:underline text-sm font-semibold">
                                Voir tous les articles
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </section>
</x-layout>
