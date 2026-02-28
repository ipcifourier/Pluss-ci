<x-layout>
    {{-- 1. En-tête (Style conservé) --}}
    <section class="bg-brand-green text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Centre de Documentation</h1>
            <p class="opacity-90 text-lg max-w-2xl mx-auto">
                Accédez à l'ensemble des rapports, bulletins, textes juridiques et guides techniques de la plateforme Une Seule Santé.
            </p>
        </div>
    </section>

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            
            {{-- 2. ZONE DE FILTRES ET RECHERCHE --}}
            <div class="max-w-7xl mx-auto mb-10">
                <form action="{{ route('documents.index') }}" method="GET" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        
                        {{-- Recherche --}}
                        <div class="md:col-span-4 lg:col-span-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Mots-clés</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Titre..." 
                                       class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange">
                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>

                        {{-- Filtre Type --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Type</label>
                            <select name="type" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les types</option>
                                @foreach($types as $key => $val)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Filtre Domaine (Nouveau) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Domaine</label>
                            <select name="domain" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les domaines</option>
                                @foreach($domains as $dom)
                                    <option value="{{ $dom }}" {{ request('domain') == $dom ? 'selected' : '' }}>{{ $dom }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Filtre GTT --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Par GTT</label>
                            <select name="gtt" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les GTT</option>
                                @foreach($gtts as $gtt)
                                    <option value="{{ $gtt->id }}" {{ request('gtt') == $gtt->id ? 'selected' : '' }}>{{ $gtt->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Bouton Reset (visible seulement si filtre actif) --}}
                        @if(request()->anyFilled(['search', 'type', 'domain', 'gtt']))
                            <div class="md:col-span-4 flex justify-end mt-2">
                                <a href="{{ route('documents.index') }}" class="text-xs font-bold text-red-500 hover:text-red-700 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Effacer les filtres
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            
            {{-- 3. GRILLE DES RESULTATS --}}
            <div class="max-w-7xl mx-auto">
                @if(isset($documents) && $documents->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($documents as $doc)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition duration-300 flex flex-col h-full group relative overflow-hidden">
                                
                                {{-- Bandeau Domaine (Haut de carte) --}}
                                @if($doc->domain)
                                    <div class="absolute top-0 right-0 bg-gray-100 text-gray-600 text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wide">
                                        {{ $doc->domain }}
                                    </div>
                                @endif

                                <div class="flex items-start gap-4 mb-3 mt-2">
                                    {{-- Icône dynamique selon le type --}}
                                    <div class="shrink-0 w-12 h-12 rounded-lg flex items-center justify-center 
                                        {{ in_array($doc->type, ['Rapport', 'Bulletin', 'Guide technique']) ? 'bg-blue-50 text-blue-600' : 
                                           (in_array($doc->type, ['Arrêté', 'Décret', 'Loi']) ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600') }}">
                                        
                                        @if(in_array($doc->type, ['Rapport', 'Bulletin']))
                                            {{-- Icone Document Texte --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        @elseif(in_array($doc->type, ['Arrêté', 'Décret', 'Loi']))
                                            {{-- Icone Balance/Juridique --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                        @else
                                            {{-- Icone par défaut --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>

                                    <div>
                                        {{-- Type --}}
                                        <span class="inline-block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                            {{ $doc->type }}
                                        </span>
                                        {{-- Badge GTT si lié --}}
                                        @if($doc->gtt)
                                            <div class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-brand-orange/10 text-brand-orange">
                                                {{ Str::limit($doc->gtt->name, 20) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Titre --}}
                                <h3 class="font-bold text-gray-800 text-lg leading-snug mb-2 group-hover:text-brand-orange transition-colors">
                                    {{ $doc->title }}
                                </h3>

                                {{-- Sous-domaine --}}
                                @if($doc->sub_domain)
                                    <p class="text-sm text-gray-500 italic mb-4 line-clamp-2" title="{{ $doc->sub_domain }}">
                                        {{ $doc->sub_domain }}
                                    </p>
                                @endif

                                {{-- Footer de la carte --}}
                                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <div class="text-xs text-gray-400">
                                        Publié le {{ $doc->published_at ? $doc->published_at->format('d/m/Y') : $doc->created_at->format('d/m/Y') }}
                                    </div>
                                    
                                    {{-- Bouton Download --}}
                                    <a href="{{ route('documents.download', $doc) }}" class="flex items-center gap-2 text-brand-green font-bold text-sm hover:text-green-700 hover:underline transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Télécharger
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-12">
                        {{ $documents->links() }}
                    </div>

                @else
                    {{-- État vide --}}
                    <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun document trouvé</h3>
                        <p class="text-gray-500 mb-6">Essayez de modifier vos critères de recherche ou réinitialisez les filtres.</p>
                        <a href="{{ route('documents.index') }}" class="inline-block bg-brand-orange text-white px-6 py-2 rounded-lg font-bold hover:bg-orange-600 transition">
                            Voir tous les documents
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </section>
</x-layout>