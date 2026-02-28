<x-layout 
    title="Résultats de recherche - PLUSS.CI" 
    description="Résultats de votre recherche sur la plateforme Une Seule Santé."
>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4 max-w-5xl">
            
            {{-- En-tête de la recherche --}}
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-extrabold text-blue-900 mb-4">Recherche globale</h1>
                
                {{-- Grande barre de recherche centrale --}}
                <form action="{{ route('search') }}" method="GET" class="max-w-2xl mx-auto flex shadow-sm rounded-full overflow-hidden border border-gray-200">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Rechercher une actualité, un GTT, un rapport..." class="w-full px-6 py-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-orange border-none">
                    <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-8 font-bold transition">
                        Rechercher
                    </button>
                </form>

                @if($q)
                    <p class="text-gray-500 mt-4">
                        Résultats pour : <strong class="text-gray-900">"{{ $q }}"</strong> 
                        ({{ $articles->count() + $gtts->count() + $documents->count() }} résultats)
                    </p>
                @endif
            </div>

            {{-- Affichage des résultats s'il y a une requête --}}
            @if($q)
                <div class="space-y-12">

                    {{-- 1. Résultats : GTT --}}
                    @if($gtts->count() > 0)
                        <section>
                            <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-200 pb-2">Groupes de Travail ({{ $gtts->count() }})</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($gtts as $gtt)
                                    <a href="{{ route('gtts.show', $gtt) }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:border-blue-500 transition group flex items-center gap-4">
                                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-500 font-bold shrink-0">
                                            {{ substr($gtt->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800 group-hover:text-blue-600">{{ $gtt->name }}</h3>
                                            <p class="text-sm text-gray-500 line-clamp-1">Voir les détails de ce GTT</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- 2. Résultats : ARTICLES --}}
                    @if($articles->count() > 0)
                        <section>
                            <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-200 pb-2">Actualités ({{ $articles->count() }})</h2>
                            <div class="space-y-4">
                                @foreach($articles as $article)
                                    <a href="{{ route('articles.show', $article) }}" class="block bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:border-brand-orange transition">
                                        <h3 class="font-bold text-gray-800 text-lg">{{ $article->title }}</h3>
                                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ strip_tags($article->content) }}</p>
                                        <span class="text-xs text-brand-orange font-semibold mt-2 block">{{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- 3. Résultats : DOCUMENTS --}}
                    @if($documents->count() > 0)
                        <section>
                            <h2 class="text-xl font-bold text-gray-900 mb-4 border-b border-gray-200 pb-2">Bibliothèque ({{ $documents->count() }})</h2>
                            <ul class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
                                @foreach($documents as $doc)
                                    <li>
                                        <a href="{{ route('documents.download', $doc) }}" class="flex items-center p-4 hover:bg-gray-50 transition">
                                            <svg class="w-6 h-6 text-green-600 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <span class="font-semibold text-gray-700 hover:text-green-600">{{ $doc->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Aucun résultat --}}
                    @if($articles->isEmpty() && $gtts->isEmpty() && $documents->isEmpty())
                        <div class="text-center bg-white rounded-xl p-12 border border-gray-100 shadow-sm">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h3 class="text-xl font-bold text-gray-900">Aucun résultat trouvé</h3>
                            <p class="text-gray-500 mt-2">Essayez avec d'autres mots-clés ou vérifiez l'orthographe.</p>
                        </div>
                    @endif

                </div>
            @endif

        </div>
    </div>
</x-layout>