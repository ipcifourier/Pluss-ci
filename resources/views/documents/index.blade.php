<x-layout>
    {{-- EN-TÊTE --}}
    <section class="bg-brand-green text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Centre de Documentation</h1>
            <p class="opacity-90 text-lg max-w-2xl mx-auto">
                Accédez à l'ensemble des rapports, bulletins, textes juridiques et guides techniques.
            </p>
        </div>
    </section>

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            
            {{-- FORMULAIRE DE FILTRES --}}
            <div class="max-w-7xl mx-auto mb-10">
                <form action="{{ route('documents.index') }}" method="GET" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        
                        {{-- Mots-clés --}}
                        <div class="md:col-span-4 lg:col-span-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Mots-clés</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Titre..." 
                                   class="w-full pl-3 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange">
                        </div>

                        {{-- Type --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Type</label>
                            <select name="type" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les types</option>
                                @foreach($types as $key => $val)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Domaine --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Domaine</label>
                            <select name="domain" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les domaines</option>
                                @foreach($domains as $dom)
                                    <option value="{{ $dom }}" {{ request('domain') == $dom ? 'selected' : '' }}>{{ $dom }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- GTT --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Par GTT</label>
                            <select name="gtt" class="w-full py-2 px-3 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:ring-brand-orange focus:border-brand-orange" onchange="this.form.submit()">
                                <option value="">Tous les GTT</option>
                                @foreach($gtts as $gtt)
                                    <option value="{{ $gtt->id }}" {{ request('gtt') == $gtt->id ? 'selected' : '' }}>{{ $gtt->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Reset --}}
                        @if(request()->anyFilled(['search', 'type', 'domain', 'gtt']))
                            <div class="md:col-span-4 flex justify-end mt-2">
                                <a href="{{ route('documents.index') }}" class="text-xs font-bold text-red-500 hover:text-red-700 flex items-center gap-1">
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

                                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <div class="text-xs text-gray-400">
                                        Publié le {{ $doc->published_at ? $doc->published_at->format('d/m/Y') : $doc->created_at->format('d/m/Y') }}
                                    </div>
                                    <a href="{{ route('documents.download', $doc) }}" class="flex items-center gap-2 text-brand-green font-bold text-sm hover:text-green-700 hover:underline transition">
                                        Télécharger
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12 flex justify-center">
                        {{ $documents->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                        <p class="text-gray-500">Aucun document trouvé.</p>
                        <a href="{{ route('documents.index') }}" class="inline-block mt-4 text-brand-orange font-bold">Réinitialiser</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout>