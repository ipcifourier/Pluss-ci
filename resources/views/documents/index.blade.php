<x-layout>
    {{-- EN-TÊTE avec barre de recherche intelligente --}}
    <section class="bg-brand-green text-white pt-12 pb-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Centre de Documentation</h1>
            <p class="opacity-90 text-lg max-w-2xl mx-auto mb-8">
                Accédez à l'ensemble des rapports, bulletins, textes juridiques et guides techniques.
            </p>

            {{-- ZONE DE RECHERCHE INTELLIGENTE --}}
            <div
                x-data="{
                    query: '{{ addslashes(request('search', '')) }}',
                    suggestions: [],
                    open: false,
                    timer: null,
                    fetchSuggestions(val) {
                        clearTimeout(this.timer);
                        if (val.length < 2) { this.suggestions = []; this.open = false; return; }
                        this.timer = setTimeout(async () => {
                            const res = await fetch('{{ route('documents.suggestions') }}?q=' + encodeURIComponent(val));
                            this.suggestions = await res.json();
                            this.open = this.suggestions.length > 0;
                        }, 280);
                    },
                    select(url) {
                        this.open = false;
                        window.location.href = url;
                    }
                }"
                @click.outside="open = false"
                class="relative max-w-2xl mx-auto"
            >
                <form action="{{ route('documents.index') }}" method="GET" class="relative flex" @submit="open = false">
                    <div class="relative flex-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            x-model="query"
                            @input="fetchSuggestions($event.target.value)"
                            @keydown.escape="open = false"
                            @keydown.enter="open = false"
                            placeholder="Rechercher un rapport, décret, guide…"
                            autocomplete="off"
                            class="w-full pl-12 pr-4 py-4 text-gray-800 bg-white rounded-l-xl text-base focus:outline-none focus:ring-2 focus:ring-brand-orange"
                        >
                    </div>
                    <button type="submit"
                        class="px-6 py-4 bg-brand-orange hover:bg-orange-600 text-white font-bold text-sm rounded-r-xl transition whitespace-nowrap">
                        Rechercher
                    </button>
                </form>

                {{-- Suggestions autocomplete --}}
                <div
                    x-show="open && suggestions.length > 0"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute z-50 w-full bg-white rounded-xl shadow-2xl mt-1 overflow-hidden text-left"
                    style="display:none"
                >
                    <template x-for="(s, i) in suggestions" :key="i">
                        <button
                            type="button"
                            @click="select(s.url)"
                            class="w-full flex items-start gap-3 px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0 transition"
                        >
                            <div class="shrink-0 w-8 h-8 rounded bg-brand-green/10 flex items-center justify-center mt-0.5">
                                <svg class="w-4 h-4 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="text-left min-w-0">
                                <div class="text-sm font-semibold text-gray-800 truncate" x-text="s.title"></div>
                                <div class="text-xs text-gray-400 mt-0.5" x-text="[s.type, s.domain].filter(Boolean).join(' · ')"></div>
                            </div>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            
            {{-- FORMULAIRE DE FILTRES COMPLÉMENTAIRES --}}
            <div class="max-w-7xl mx-auto mb-10">
                <form action="{{ route('documents.index') }}" method="GET" class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                    {{-- Afficher le filtre actif en haut si recherche en cours --}}
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
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        {{-- Type --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Type de document</label>
                            <select name="type" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les types</option>
                                @foreach($types as $key => $val)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Domaine --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Domaine GHSA</label>
                            <select name="domain" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les domaines</option>
                                @foreach($domains as $dom)
                                    <option value="{{ $dom }}" {{ request('domain') == $dom ? 'selected' : '' }}>{{ $dom }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- GTT --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Groupe Technique Thématique</label>
                            <select name="gtt" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les GTT</option>
                                @foreach($gtts as $gtt)
                                    <option value="{{ $gtt->id }}" {{ request('gtt') == $gtt->id ? 'selected' : '' }}>{{ $gtt->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Reset --}}
                        @if(request()->anyFilled(['search', 'type', 'domain', 'gtt']))
                            <div class="md:col-span-3 flex items-center justify-between border-t border-gray-100 pt-3 mt-1">
                                <p class="text-xs text-gray-400">
                                    {{ $documents->total() }} document(s) trouvé(s)
                                </p>
                                <a href="{{ route('documents.index') }}" class="text-xs font-bold text-red-500 hover:text-red-700 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Effacer les filtres
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            
            {{-- GRILLE DES RÉSULTATS --}}
            <div class="max-w-7xl mx-auto">
                @if(isset($documents) && $documents->count() > 0)
                    {{-- Compteur résultats --}}
                    <p class="text-sm text-gray-500 mb-6">
                        Affichage de <span class="font-bold text-gray-700">{{ $documents->firstItem() }}</span> à
                        <span class="font-bold text-gray-700">{{ $documents->lastItem() }}</span> sur
                        <span class="font-bold text-gray-700">{{ $documents->total() }}</span> documents
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($documents as $doc)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition duration-300 flex flex-col h-full group relative overflow-hidden">
                                
                                {{-- Badge Domaine --}}
                                @if($doc->domain)
                                    <div class="absolute top-0 right-0 bg-gray-100 text-gray-600 text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wide">
                                        {{ $doc->domain }}
                                    </div>
                                @endif

                                <div class="flex items-start gap-4 mb-3 mt-2">
                                    {{-- Icône --}}
                                    <div class="shrink-0 w-12 h-12 rounded-lg flex items-center justify-center bg-gray-50 text-brand-orange">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>

                                    <div>
                                        <span class="inline-block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                            {{ $doc->type }}
                                        </span>
                                        @if($doc->gtt)
                                            <div class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-brand-orange/10 text-brand-orange">
                                                {{ Str::limit($doc->gtt->name, 20) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <h3 class="font-bold text-gray-800 text-lg leading-snug mb-2 group-hover:text-brand-orange transition-colors">
                                    {{ $doc->title }}
                                </h3>

                                @if($doc->sub_domain)
                                    <p class="text-sm text-gray-500 italic mb-4 line-clamp-2" title="{{ $doc->sub_domain }}">
                                        {{ $doc->sub_domain }}
                                    </p>
                                @endif

                                {{-- Pied de carte : date + compteur + téléchargement --}}
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="text-xs text-gray-400">
                                            Publié le {{ $doc->published_at ? $doc->published_at->format('d/m/Y') : $doc->created_at->format('d/m/Y') }}
                                        </div>
                                        {{-- Compteur de téléchargements --}}
                                        <div class="flex items-center gap-1 text-xs text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                                            </svg>
                                            <span>{{ number_format($doc->download_count ?? 0) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        {{-- Aperçu --}}
                                        <a href="{{ route('documents.preview', $doc) }}" target="_blank"
                                           class="flex items-center justify-center gap-1.5 flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-800 font-semibold text-sm rounded-lg transition duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Aperçu
                                        </a>
                                        {{-- Télécharger --}}
                                        <a href="{{ route('documents.download', $doc) }}"
                                           class="flex items-center justify-center gap-1.5 flex-1 py-2 bg-brand-green/10 hover:bg-brand-green text-brand-green hover:text-white font-bold text-sm rounded-lg transition duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                                            </svg>
                                            Télécharger
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-12 flex flex-col items-center gap-4">
                        {{ $documents->links() }}
                        <p class="text-xs text-gray-400">
                            Page {{ $documents->currentPage() }} sur {{ $documents->lastPage() }}
                        </p>
                    </div>
                @else
                    <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Aucun document ne correspond à votre recherche.</p>
                        <a href="{{ route('documents.index') }}" class="inline-block mt-4 px-6 py-2 bg-brand-orange text-white font-bold text-sm rounded-lg hover:bg-orange-600 transition">
                            Réinitialiser les filtres
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout>