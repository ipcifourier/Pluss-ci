<x-layout>

    {{-- ========================================== --}}
    {{-- 1. BANNIÈRE HERO                           --}}
    {{-- ========================================== --}}
    {{-- J'ai augmenté un peu la hauteur sur desktop (h-96 au lieu de h-80) pour donner plus d'air à l'image --}}
    <div class="relative bg-blue-900 h-72 md:h-96 flex items-center justify-center overflow-hidden">
        
        {{-- Image de fond --}}
        {{-- CORRECTION 1 : On remet 'object-center' pour centrer l'image verticalement --}}
        {{-- J'ai aussi légèrement augmenté l'opacité de l'image elle-même (de 40 à 50) --}}
        @if(isset($page->image) && $page->image)
            <img src="{{ Storage::url($page->image) }}" class="absolute inset-0 w-full h-full object-cover object-center opacity-50">
        @elseif(isset($page->cover_image) && $page->cover_image)
            <img src="{{ Storage::url($page->cover_image) }}" class="absolute inset-0 w-full h-full object-cover object-center opacity-50">
        @else
            {{-- Option de secours --}}
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800 opacity-90"></div>
        @endif
        
        {{-- Voile sombre/bleu --}}
        {{-- CORRECTION 2 : L'opacité est passée de 60% (/60) à 40% (/40) pour un bleu plus léger --}}
        <div class="absolute inset-0 bg-blue-900/40 mix-blend-multiply"></div>
        
        <div class="relative z-10 text-center px-4 mt-10">
             {{-- Ajout d'une ombre portée noire (drop-shadow-xl) pour que le texte reste lisible sur le fond plus clair --}}
            <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-xl tracking-tight">
                {{ $page->title ?? 'Présentation' }}
            </h1>
            <div class="w-24 h-1 bg-brand-orange mx-auto mt-6 rounded-full shadow-sm"></div>
        </div>
    </div>
    

    {{-- ========================================== --}}
    {{-- 2. CONTENU PRINCIPAL (L'ENCADRÉ)           --}}
    {{-- ========================================== --}}
    {{-- Fond légèrement grisé pour faire ressortir l'encadré blanc --}}
    <div class="py-16 bg-gray-50 min-h-screen">
        
        {{-- max-w-4xl empêche le texte d'être trop large (idéal pour la lecture) --}}
        <div class="container mx-auto px-4 max-w-4xl relative -mt-24 z-20">
            
            {{-- L'ENCADRÉ BLANC AVEC BORDURE BLEU ROI --}}
            <div class="bg-white rounded-xl shadow-xl border border-gray-100 border-t-8 border-t-blue-900 p-8 md:p-12 lg:p-16">
                
                {{-- Icône décorative (Optionnel) --}}
                <div class="hidden md:block absolute top-0 right-12 transform -translate-y-1/2">
                    <div class="bg-blue-900 text-white p-4 rounded-full shadow-lg border-4 border-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                {{-- CONTENU FILAMENT (RichText) --}}
                {{-- La classe 'prose' de Tailwind met en forme automatiquement le HTML brut --}}
                <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed prose-headings:text-blue-900 prose-a:text-brand-orange">
                    {{-- Adaptez $page->content selon votre base de données --}}
                    {!! $page->content ?? $page->description !!}
                </div>
                
            </div>
            
            {{-- Bouton de retour (Optionnel) --}}
            <div class="mt-8 text-center">
                <a href="/" class="inline-flex items-center text-blue-900 font-bold hover:text-brand-orange transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour à l'accueil
                </a>
            </div>

        </div>
    </div>
</x-layout>