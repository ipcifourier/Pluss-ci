<x-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-4xl">
            
            {{-- Fil d'ariane --}}
            <nav class="flex text-sm text-gray-500 mb-6">
                <a href="/" class="hover:text-brand-orange">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-brand-orange">Actualités</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-semibold truncate">{{ Str::limit($article->title, 50) }}</span>
            </nav>

            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                {{-- Image de couverture --}}
                @if($article->image_path)
                    <div class="h-64 md:h-96 w-full overflow-hidden relative">
                        <img src="{{ asset('storage/' . $article->image_path) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    </div>
                @endif

                <div class="p-8 md:p-12">
                    
                    {{-- Méta-données --}}
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6">
                        {{-- Date --}}
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </div>

                        {{-- Catégorie --}}
                        @if($article->category)
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full font-medium text-xs uppercase tracking-wide">
                                {{ $article->category }}
                            </span>
                        @endif

                        {{-- GTT (Lien sécurisé) --}}
                        @if($article->gtt)
                            <a href="{{ route('gtts.show', $article->gtt) }}" class="flex items-center gap-1 text-brand-orange font-bold hover:underline bg-brand-orange/10 px-3 py-1 rounded-full text-xs uppercase tracking-wide transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ $article->gtt->name }}
                            </a>
                        @endif
                    </div>

                    {{-- Titre --}}
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-8 leading-tight">
                        {{ $article->title }}
                    </h1>

                    {{-- Contenu --}}
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $article->content !!}
                    </div>

                    {{-- Commentaires --}}
                    {{-- Section des commentaires --}}
<section class="mt-12 border-t pt-8">
    <h3 class="text-2xl font-bold mb-6">Commentaires ({{ $article->comments->count() }})</h3>

    {{-- Liste des commentaires approuvés --}}
    @forelse($article->comments as $comment)
        <div class="bg-gray-50 p-4 rounded-lg mb-4 border border-gray-100">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-semibold">{{ $comment->name }}</p>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
            <p class="text-gray-700">{{ $comment->content }}</p>
        </div>
    @empty
        <p class="text-gray-500 italic">Soyez le premier à commenter !</p>
    @endforelse

    {{-- Formulaire d'ajout --}}
    <div class="mt-8 bg-white p-6 rounded-lg border border-gray-200">
        <h4 class="text-lg font-bold mb-4">Laisser un commentaire</h4>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('articles.comment', $article) }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-orange focus:border-transparent">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-orange focus:border-transparent">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Commentaire *</label>
                <textarea name="content" id="content" rows="4" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-orange focus:border-transparent">{{ old('content') }}</textarea>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-brand-orange text-white font-semibold px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                Publier le commentaire
            </button>
        </form>
    </div>
</section>


                    {{-- Bouton Retour --}}
                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center text-brand-green font-bold hover:underline gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Retour aux actualités
                        </a>
                    </div>

                </div>
            </article>
        </div>
    </div>
</x-layout>