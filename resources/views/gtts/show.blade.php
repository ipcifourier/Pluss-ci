<x-layout>

    {{-- ========================================== --}}
    {{-- 1. BANNIÈRE HERO (COVER IMAGE & LOGO)      --}}
    {{-- ========================================== --}}
    <div class="relative bg-gray-900 h-64 md:h-80 flex items-center overflow-hidden">
        
        {{-- Image de fond (Cover) --}}
        @if($gtt->cover_image)
            <img src="{{ asset('storage/' . $gtt->cover_image) }}" class="absolute inset-0 w-full h-full object-cover opacity-40">
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-800 opacity-90"></div>
        @endif
        
        <div class="container mx-auto px-4 relative z-10 text-center md:text-left flex flex-col md:flex-row items-center gap-8 mt-8 md:mt-0">
            
            {{-- Logo GTT flottant --}}
            <div class="bg-white p-2 rounded-full shadow-lg shrink-0">
                @if($gtt->logo)
                    <img src="{{ asset('storage/' . $gtt->logo) }}" class="w-24 h-24 rounded-full object-contain">
                @else
                    <div class="w-24 h-24 rounded-full bg-orange-50 flex items-center justify-center">
                        <span class="text-3xl font-bold text-orange-500">{{ substr($gtt->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>
            
            {{-- Titre --}}
            <div>
                <span class="text-orange-400 font-bold tracking-wider uppercase text-sm drop-shadow-md">
                    Groupe Technique de Travail
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 drop-shadow-lg">
                    {{ $gtt->name }}
                </h1>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 2. CONTENU PRINCIPAL (GRILLE 8 / 4)        --}}
    {{-- ========================================== --}}
    <div class="container mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        {{-- COLONNE GAUCHE : Présentation (8 colonnes) --}}
        <div class="lg:col-span-8">
            <div class="bg-white rounded-xl p-8 md:p-10 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center pb-4 border-b border-gray-100">
                    <span class="w-2 h-8 bg-orange-500 rounded-full mr-3"></span>
                    Présentation & Missions
                </h2>
                
                {{-- Contenu riche (Généré par FilamentPHP) --}}
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $gtt->content ?? $gtt->description !!}
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE : Sidebar (4 colonnes) --}}
        <div class="lg:col-span-4 space-y-8">
            
            {{-- ====================================== --}}
            {{-- WIDGET 1 : DOCUMENTS ASSOCIÉS          --}}
            {{-- ====================================== --}}
            @if(isset($relatedDocuments) && $relatedDocuments->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border-t-4 border-green-600 p-6">
                <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Ressources du GTT
                </h3>
                <ul class="divide-y divide-gray-100">
                    @foreach($relatedDocuments as $doc)
                        <li class="py-3 first:pt-0 last:pb-0">
                            <a href="{{ route('documents.download', $doc) }}" class="group block hover:bg-gray-50 p-2 -mx-2 rounded transition">
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-green-600 line-clamp-2">{{ $doc->title }}</span>
                                <span class="text-xs text-gray-400 mt-1 block">Publié le {{ $doc->created_at->format('d/m/Y') }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- ====================================== --}}
            {{-- WIDGET 2 : ACTIVITÉS RÉCENTES          --}}
            {{-- ====================================== --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        Activités du GTT
                    </h3>
                </div>

                <div class="divide-y divide-gray-100">
                    {{-- On utilise $relatedArticles venant du Contrôleur (ou $gtt->articles en fallback) --}}
                    @forelse($relatedArticles ?? $gtt->articles->take(3) as $article)
                        <div class="p-5 hover:bg-gray-50 transition-colors group">
                            <div class="flex gap-4">
                                
                                {{-- Image de l'article --}}
                                @if($article->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($article->image_path)) 
                                    <img src="{{ asset('storage/' . $article->image_path) }}" class="w-16 h-16 rounded-lg object-cover shrink-0 group-hover:scale-105 transition">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-orange-100 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif

                                {{-- Titre et Date --}}
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs font-bold text-orange-500 uppercase tracking-wider">Info</span>
                                        <span class="text-xs text-gray-400">{{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-800 leading-snug group-hover:text-orange-500 transition-colors">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            {{ Str::limit($article->title, 50) }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500 text-sm italic">
                            Aucune activité publiée récemment par ce GTT.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ====================================== --}}
            {{-- WIDGET 3 : CONTACT RAPIDE              --}}
            {{-- ====================================== --}}
            <div class="bg-orange-500 rounded-xl p-8 text-white text-center shadow-lg relative overflow-hidden group">
                <div class="absolute inset-0 bg-orange-600 w-0 group-hover:w-full transition-all duration-500 ease-out z-0"></div>
                <div class="relative z-10">
                    <h3 class="font-bold text-xl mb-2">Besoin d'information ?</h3>
                    <p class="text-orange-100 text-sm mb-6">Contactez le secrétariat technique de ce groupe de travail.</p>
                    <a href="{{ route('contact') }}" class="inline-block bg-white text-orange-600 font-bold py-3 px-8 rounded-full hover:shadow-xl hover:scale-105 transition transform shadow-sm">
                        Nous contacter
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout>