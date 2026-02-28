<x-layout>
    <div class="relative w-full h-72 md:h-96 bg-gray-900 flex items-end overflow-hidden">
        
        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="absolute inset-0 w-full h-full object-cover opacity-70">
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-gray-800 opacity-90"></div>
        @endif

        <div class="relative z-10 container mx-auto px-4 pb-10">
            <span class="inline-block py-1 px-3 rounded bg-brand-orange text-white text-xs font-bold tracking-wider mb-3">
                ACTUALITÉ
            </span>
            <h1 class="text-3xl md:text-5xl font-bold text-white drop-shadow-md leading-tight mb-4 max-w-4xl">
                {{ $article->title }}
            </h1>
            <div class="flex items-center text-gray-300 text-sm gap-4">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $article->created_at->format('d/m/Y') }}
                </div>
                </div>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            
            <nav class="flex mb-8 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-brand-orange">Accueil</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">Article</span>
            </nav>

            <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed text-justify">
                {!! $article->content !!}
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100">
                <a href="{{ route('home') }}" class="inline-flex items-center text-brand-orange font-semibold hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour à l'accueil
                </a>
            </div>

        </div>
    </section>
</x-layout>