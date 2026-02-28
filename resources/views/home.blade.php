<x-layout>

{{-- ========================================== --}}
{{-- SECTION BANDE D'ANNONCE (FLASH INFO)       --}}
{{-- ========================================== --}}
@if(isset($flashInfos) && $flashInfos->count() > 0)
<div class="bg-gray-900 text-white relative overflow-hidden h-10 flex items-center border-b border-gray-800">
    
    {{-- Label Fixe à gauche --}}
    <div class="bg-brand-orange text-white text-xs font-bold uppercase px-4 h-full flex items-center z-20 shadow-md">
        <span class="animate-pulse mr-2">●</span> Flash Info
    </div>

    {{-- Le contenu défilant --}}
    <div class="flex-1 overflow-hidden relative h-full flex items-center">
        <div class="whitespace-nowrap animate-marquee hover:[animation-play-state:paused] flex items-center">
            
            {{-- BOUCLE 1 --}}
            @foreach($flashInfos as $info)
                <span class="mx-6 text-sm flex items-center">
                    <span class="text-brand-orange mr-2">[{{ $info->created_at->format('d/m') }}]</span>
                    <a href="{{ route('articles.show', $info->slug) }}" class="hover:text-brand-orange transition">
                        {{ $info->title }}
                    </a>
                </span>
                <span class="text-gray-600">|</span>
            @endforeach

            {{-- BOUCLE 2 (Duplication pour fluidité) --}}
            @foreach($flashInfos as $info)
                <span class="mx-6 text-sm flex items-center">
                    <span class="text-brand-orange mr-2">[{{ $info->created_at->format('d/m') }}]</span>
                    <a href="{{ route('articles.show', $info->slug) }}" class="hover:text-brand-orange transition">
                        {{ $info->title }}
                    </a>
                </span>
                <span class="text-gray-600">|</span>
            @endforeach

        </div>
    </div>
</div>
@endif

{{-- ========================================== --}}
{{-- SECTION HERO (SLIDER)                      --}}
{{-- ========================================== --}}
<div 
    x-data="{ 
        activeSlide: 0, 
        slides: [
            '/images/famille.jpg', 
            '/images/presentation.jpg', 
            '/images/travaux.jpg', 
            '/images/logo.png'
        ],
        timer: null
    }" 
    x-init="timer = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)"
    class="relative w-full h-96 md:h-[500px] flex items-center justify-center overflow-hidden bg-gray-900"
>
    <template x-for="(slide, index) in slides" :key="index">
        <div 
            x-show="activeSlide === index"
            x-transition:enter="transition ease-in-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 w-full h-full"
        >
            <img :src="slide" class="w-full h-full object-cover" alt="Fond bannière">
        </div>
    </template>

    <div class="absolute inset-0 bg-black/50 bg-gradient-to-t from-black/80 to-transparent z-10"></div>

    <div class="relative z-20 text-center px-4 max-w-5xl mx-auto animate-fade-in-up">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight drop-shadow-xl mb-4">
            Plateforme <span class="text-brand-orange">Une Seule Santé</span>
        </h1>
        <p class="text-lg md:text-2xl text-gray-200 font-light max-w-3xl mx-auto">
            Interconnexion des systèmes de Santé pour une veille sanitaire optimale en Côte d'Ivoire.
        </p>
        <div class="mt-8">
            <a href="#actualites" class="inline-block bg-brand-orange text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-orange-600 hover:scale-105 transition transform duration-300">
                Découvrir nos activités
            </a>
        </div>
    </div>

    <div class="absolute bottom-6 left-0 right-0 z-30 flex justify-center gap-3">
        <template x-for="(slide, index) in slides" :key="index">
            <button 
                @click="activeSlide = index; clearInterval(timer); timer = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)"
                class="w-3 h-3 rounded-full transition-all duration-300 border border-white/50"
                :class="activeSlide === index ? 'bg-brand-orange w-8' : 'bg-white/50 hover:bg-white'"
            ></button>
        </template>
    </div>
</div>

{{-- ========================================== --}}
{{-- SECTION LEADERSHIP / BIOGRAPHIE            --}}
{{-- ========================================== --}}
<section class="py-12 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-orange-50 blur-3xl opacity-50"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12">

            {{-- PHOTO --}}
            <div class="w-full lg:w-5/12">
                <div class="relative group">
                    <div class="absolute inset-0 bg-brand-orange transform translate-x-3 translate-y-3 rounded-2xl transition duration-500 group-hover:translate-x-2 group-hover:translate-y-2"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-lg aspect-[4/5] bg-gray-200">
                        <img src="{{ asset('images/cordo.png') }}" 
                             alt="Dr Djeneba OUATTARA" 
                             class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-6 pt-12">
                            <p class="text-white font-bold text-lg">Dr Djeneba OUATTARA</p>
                            <p class="text-brand-orange text-sm font-semibold uppercase">Coordonnatrice Générale</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TEXTE --}}
            <div class="w-full lg:w-7/12">
                <div class="pl-0 lg:pl-10">
                    <span class="text-brand-orange font-bold uppercase tracking-wider text-sm mb-2 block">Leadership & Vision</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                        L'Excellence au service de <br>
                        <span class="text-brand-orange">la population</span>
                    </h2>
                    
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        "Notre mission chez PLUSS CI est de transformer les défis complexes en opportunités de santé durable. Nous nous engageons à oeuvrer pour le bien être de chaque citoyen  en Côte d'Ivoire."
                    </p>

                    <div class="bg-gray-50 border-l-4 border-brand-orange p-4 mb-8">
                        <p class="italic text-gray-500 text-sm">
                            Docteur en Pharmacie, PhD en santé pulbique, Djeneba OUATTARA apporte une expertise pointue à la Plateforme Une Seule Santé en Côte d'Ivoire.
                        </p>
                    </div>

                    @if(Route::has('presentation.biographie'))
                    <a href="{{ route('presentation.biographie') }}" class="group inline-flex items-center gap-2 bg-gray-900 text-white px-8 py-3 rounded-full font-semibold transition hover:bg-brand-orange hover:shadow-lg">
                        Lire la biographie complète
                        <svg class="w-5 h-5 transition transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========================================== --}}
{{-- SECTION HISTORIQUE DYNAMIQUE               --}}
{{-- ========================================== --}}
@if(isset($histories) && $histories->count() > 0)
<section class="py-10 bg-white relative">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-4xl font-extrabold text-brand-orange">Historique de la Plateforme Une Seule Santé</h2>
        </div>

        {{-- Conteneur Alpine.js : on définit l'année active sur la première de la liste --}}
        <div x-data="{ activeYear: {{ $histories->first()->year }} }" class="w-full mt-8">
            
            {{-- LES ONGLETS (Les Années) --}}
            <div class="flex justify-center items-end flex-wrap">
                @foreach($histories as $history)
                    <button 
                        @click="activeYear = {{ $history->year }}"
                        class="px-6 py-3 font-bold text-lg md:text-xl transition-all duration-300 relative border-2 border-b-0 -mb-[2px] rounded-t-lg"
                        :class="activeYear === {{ $history->year }} 
                            ? 'border-brand-orange text-brand-orange bg-white z-10' 
                            : 'border-transparent text-gray-400 hover:text-brand-orange z-0'"
                    >
                        {{ $history->year }}
                        
                        {{-- Masque magique pour effacer la bordure du bas sur l'onglet actif --}}
                        <div x-show="activeYear === {{ $history->year }}" class="absolute bottom-[-2px] left-0 right-0 h-[4px] bg-white"></div>
                    </button>
                @endforeach
            </div>

            {{-- LA BOÎTE DE CONTENU (Reliée à l'onglet actif) --}}
            <div class="border-2 border-brand-orange p-8 md:p-12 bg-white relative z-0 shadow-lg rounded-b-xl rounded-tr-xl">
                @foreach($histories as $history)
                    <div 
                        x-show="activeYear === {{ $history->year }}" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="prose prose-orange max-w-none text-gray-700"
                        x-cloak
                        style="display: none;"
                    >
                        {!! $history->content !!}
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
@endif

{{-- ========================================== --}}
{{-- SECTION STATISTIQUES                       --}}
{{-- ========================================== --}}
@if(isset($stats))
<section class="bg-brand-green py-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white divide-x divide-white/20">
            <div>
                <div class="text-4xl font-bold mb-1">{{ $stats['gtts'] ?? 0 }}</div>
                <div class="text-sm uppercase tracking-wide opacity-80">Groupes de Travail</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-1">{{ $stats['articles'] ?? 0 }}</div>
                <div class="text-sm uppercase tracking-wide opacity-80">Articles Publiés</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-1">{{ $stats['documents'] ?? 0 }}</div>
                <div class="text-sm uppercase tracking-wide opacity-80">Documents Publics</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-1">4</div>
                <div class="text-sm uppercase tracking-wide opacity-80">Domaines d'action</div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ========================================== --}}
{{-- SECTION GTT À LA UNE (LINKS ACTIVÉS)       --}}
{{-- ========================================== --}}
@if(isset($featuredGtts) && $featuredGtts->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-brand-orange font-bold uppercase tracking-widest text-sm">Collaboration</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Groupes de Travail Technique</h2>
            <div class="w-24 h-1 bg-gray-300 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredGtts as $gtt)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group border border-gray-100 flex flex-col h-full">
                
                {{-- IMAGE --}}
                <div class="h-40 bg-gray-200 overflow-hidden relative">
                    @if($gtt->cover_image)
                        <img src="{{ asset('storage/' . $gtt->cover_image) }}" 
                             alt="{{ $gtt->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    @endif
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-brand-orange transition line-clamp-2">
                        {{ $gtt->name }}
                    </h3>
                    
                    <p class="text-sm text-gray-500 mb-4 line-clamp-3 flex-grow">
                        {{ Str::limit(strip_tags($gtt->description), 120) }}
                    </p>
                    
                    <a href="{{ route('gtts.show', $gtt) }}" class="text-sm font-bold text-brand-green hover:underline mt-auto flex items-center gap-1">
                        En savoir plus 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('gtts.index') }}" class="inline-block border-2 border-brand-orange text-brand-orange font-bold px-6 py-2 rounded-full hover:bg-brand-orange hover:text-white transition">
                Voir tous les GTT
            </a>
        </div>
    </div>
</section>
@endif

{{-- ========================================== --}}
{{-- SECTION DOMAINES (DYNAMIQUE)               --}}
{{-- ========================================== --}}
<section class="py-12 bg-white" x-data="{ selectedDomaine: null, modalOpen: false }">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-brand-orange font-bold uppercase tracking-widest text-sm">Notre Expertise</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Nos Domaines d'Intervention</h2>
            <div class="w-24 h-1 bg-gray-200 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($domaines as $domaine)
                <div @click="selectedDomaine = {{ Js::from([
                    'titre' => $domaine->titre,
                    'icone' => $domaine->icone,
                    'image' => $domaine->image_couverture ? asset('storage/' . $domaine->image_couverture) : null,
                    'description_courte' => $domaine->description_courte,
                    'contenu' => $domaine->contenu,
                ]) }}; modalOpen = true" 
                     class="cursor-pointer group p-8 rounded-2xl bg-blue-100 hover:bg-blue-200 hover:shadow-xl transition duration-300 border border-transparent hover:border-gray-100 text-center">
                    
                    {{-- Icône --}}
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center shadow-md mb-6 group-hover:scale-110 transition duration-300">
                        @if($domaine->icone)
                            <i class="{{ $domaine->icone }} text-brand-orange text-2xl"></i>
                        @else
                            <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Titre --}}
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $domaine->titre }}</h3>

                    {{-- Description courte (optionnelle) --}}
                    @if($domaine->description_courte)
                        <p class="text-gray-600 text-sm line-clamp-3">{{ $domaine->description_courte }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- MODALE DE DÉTAIL --}}
        <div x-show="modalOpen" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             x-transition.opacity>
            
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="modalOpen = false"></div>

            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                     @click.stop>
                    
                    <button @click="modalOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <template x-if="selectedDomaine">
                        <div class="p-6">
                            {{-- Image de couverture --}}
                            <div x-show="selectedDomaine.image" class="mb-6">
                                <img :src="selectedDomaine.image" :alt="selectedDomaine.titre" class="w-full h-64 object-cover rounded-lg">
                            </div>

                            <div class="flex items-center gap-4 mb-4">
                                {{-- Icône --}}
                                <div x-show="selectedDomaine.icone" class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i :class="selectedDomaine.icone" class="text-brand-orange text-2xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900" x-text="selectedDomaine.titre"></h2>
                            </div>

                            {{-- Description courte --}}
                            <div x-show="selectedDomaine.description_courte" class="mb-4 text-gray-700 italic border-l-4 border-brand-orange pl-4">
                                <p x-text="selectedDomaine.description_courte"></p>
                            </div>

                            {{-- Contenu détaillé --}}
                            <div class="prose max-w-none" x-html="selectedDomaine.contenu"></div>

                            <div class="mt-6 text-right">
                                <button @click="modalOpen = false" class="bg-brand-orange text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                                    Fermer
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ========================================== --}}
{{-- SECTION ACTUALITES & SIDEBAR (POLL)        --}}
{{-- ========================================== --}}
<section id="actualites" class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            
            {{-- COLONNE GAUCHE : Articles --}}
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                    <span class="text-brand-orange">●</span> Dernières Actualités
                </h2>

                @if(isset($latestArticles) && $latestArticles->count() > 0)
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach($latestArticles as $article)
                            <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col border border-gray-100">
                                <div class="h-48 bg-gray-200 overflow-hidden relative">
                                    @if($article->image_path)
                                        <img src="{{ asset('storage/' . $article->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 flex-grow flex flex-col">
                                    <div class="flex items-center text-xs text-gray-500 mb-2 gap-2">
                                        @if($article->category)
                                            <span class="bg-brand-orange/10 text-brand-orange px-2 py-1 rounded font-bold">{{ $article->category }}</span>
                                        @endif
                                        <span>{{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Récemment' }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold mb-3 text-gray-800 line-clamp-2 hover:text-brand-orange transition">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h3>
                                    <a href="{{ route('articles.show', $article->slug) }}" class="text-brand-green font-semibold mt-auto hover:underline text-sm flex items-center gap-1">
                                        Lire la suite 
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white p-6 rounded-xl border border-gray-100 text-center text-gray-500 italic">
                        Aucune actualité publiée pour le moment.
                    </div>
                @endif

                <div class="mt-8 text-center md:text-left">
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
                         Voir toutes les actualités
                    </a>
                </div>
            </div>

            {{-- COLONNE DROITE : Sidebar (fusionnée et organisée) --}}
            <div class="space-y-8">
                
                {{-- 1. SONDAGE --}}
                @if(isset($poll))
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-brand-orange">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="text-xl">🗳️</span> Sondage
                    </h3>
                    <p class="text-gray-700 font-medium mb-4">{{ $poll->question }}</p>

                    @if(session('has_voted_' . $poll->id) || !$poll->is_active)
                        {{-- Résultats --}}
                        <div class="space-y-3">
                            @php $totalVotes = $poll->total_votes; @endphp
                            @foreach($poll->options as $option)
                                @php
                                    $votes = $option['votes'] ?? 0;
                                    $label = $option['label'] ?? $option['answer'] ?? 'Option';
                                    $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100) : 0;
                                @endphp
                                <div>
                                    <div class="flex justify-between text-xs mb-1">
                                        <span>{{ $label }}</span>
                                        <span class="font-bold">{{ $percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-brand-orange h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center text-xs text-gray-400">
                            Merci de votre participation !
                        </div>
                    @else
                        {{-- Formulaire de Vote --}}
                        <form action="{{ route('poll.vote') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                            @foreach($poll->options as $index => $option)
                                @php $label = $option['label'] ?? $option['answer'] ?? 'Option'; @endphp
                                <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-100 hover:bg-orange-50 cursor-pointer transition">
                                    <input type="radio" name="option_index" value="{{ $index }}" class="text-brand-orange focus:ring-brand-orange h-4 w-4" required>
                                    <span class="text-sm text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                            <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg font-bold hover:bg-gray-800 transition mt-2 text-sm">
                                Voter
                            </button>
                        </form>
                    @endif
                </div>
                @endif

                {{-- 2. BIBLIOTHÈQUE DE DOCUMENTS --}}
                <div class="bg-white rounded-xl shadow-lg border-t-4 border-brand-green p-6 relative overflow-hidden group">
                    
                    {{-- Décoration d'arrière-plan --}}
                    <div class="absolute -right-6 -top-6 text-gray-50 group-hover:text-green-50 transition duration-500">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M4 19h6v-2H4v2zm20 0h-6v-2h6v2zm-8 2h6v-2h-6v2zm-8 0h6v-2H8v2zm8-4h6v-2h-6v2zm-8 0h6v-2H8v2zm8-4h6v-2h-6v2zm-8 0h6v-2H8v2zM4 9v2h16V9H4zm0 4h16v-2H4v2zM4 5v2h16V5H4z"/></svg>
                    </div>

                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center gap-2">
                            <span class="text-brand-green">📂</span> Bibliothèque de documents
                        </h3>
                        <p class="text-gray-600 text-sm mb-6">
                            Accédez à notre base documentaire complète : rapports, arrêtés, bulletins épidémiologiques et guides techniques.
                        </p>
                        
                        <a href="{{ route('documents.index') }}" class="block w-full text-center bg-brand-green text-white font-bold py-3 rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg transition transform hover:-translate-y-1">
                            Consulter la Bibliothèque
                        </a>
                        <div class="text-center mt-2">
                            <span class="text-[10px] text-gray-400 uppercase tracking-wider">Avec filtres de recherche</span>
                        </div>
                    </div>
                </div>

                {{-- 3. DOCUMENTS RÉCENTS --}}
                @if(isset($latestDocuments) && $latestDocuments->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Publications récentes
                    </h3>
                    <ul class="space-y-3">
                        @foreach($latestDocuments as $doc)
                            <li class="pb-3 border-b border-gray-50 last:border-0">
                                <a href="{{ route('documents.download', $doc) }}" class="group block">
                                    <span class="text-sm font-semibold text-gray-700 group-hover:text-brand-orange transition line-clamp-1">{{ $doc->title }}</span>
                                    <div class="flex justify-between items-center mt-1">
                                        <span class="text-xs text-gray-400">{{ $doc->type }}</span>
                                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded group-hover:bg-brand-orange group-hover:text-white transition">PDF</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- 4. ACCÈS RAPIDE (ESPACE PRO) --}}
                <div class="bg-brand-green text-white p-6 rounded-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 opacity-10 transform translate-x-10 -translate-y-10">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2 relative z-10">Espace Professionnel</h3>
                    <p class="text-green-100 text-sm mb-4 relative z-10">Accès réservé aux membres des groupes de travail et partenaires.</p>
                    <a href="/admin/login" class="inline-block bg-white text-brand-green px-4 py-2 rounded-lg text-sm font-bold shadow-lg hover:bg-gray-100 transition relative z-10">
                        Connexion
                    </a>
                </div>

            </div> {{-- Fin sidebar --}}
        </div> {{-- Fin grid --}}
    </div> {{-- Fin container --}}
</section>

{{-- ========================================== --}}
{{-- SECTION MÉDIATHÈQUE                        --}}
{{-- ========================================== --}}
@if(isset($medias) && $medias->count() > 0)
<section class="py-10 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900">Notre Médiathèque</h2>
            <div class="w-20 h-1 bg-brand-orange mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($medias as $media)
            <div x-data="{ open: false }" class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 group">
                <div @click="open = true" class="cursor-pointer relative h-48 overflow-hidden">
                    @if($media->cover_image)
                        <img src="{{ asset('storage/' . $media->cover_image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition transform scale-0 group-hover:scale-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 text-lg mb-3 line-clamp-1">{{ $media->title }}</h3>
                    <button @click="open = true" class="w-full text-center bg-gray-50 hover:bg-gray-900 hover:text-white text-gray-700 font-semibold py-2 rounded-lg transition duration-300">
                        Voir le média
                    </button>
                </div>

                {{-- MODALE --}}
                <div x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 p-4 backdrop-blur-sm"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div @click.away="open = false" class="bg-white rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto relative shadow-2xl">
                        <button @click="open = false" class="absolute top-4 right-4 z-10 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full p-2 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                        <div class="p-6 md:p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 pr-10">{{ $media->title }}</h3>
                            @if($media->embed_url)
                                <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden shadow-lg">
                                    <template x-if="open">
                                        <iframe src="{{ $media->embed_url }}" title="Video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
                                    </template>
                                </div>
                            @elseif($media->audio_file)
                                <audio controls class="w-full"><source src="{{ asset('storage/' . $media->audio_file) }}" type="audio/mpeg"></audio>
                            @elseif($media->cover_image)
                                {{-- AFFICHAGE DE L'IMAGE POUR LES ALBUMS --}}
                                <div class="bg-gray-50 rounded-xl overflow-hidden shadow-lg flex justify-center items-center p-2">
                                    <img src="{{ asset('storage/' . $media->cover_image) }}" alt="{{ $media->title }}" class="max-w-full h-auto max-h-[60vh] object-contain rounded-lg">
                                </div>
                            @endif
                            <div class="mt-4 text-right">
                                <button @click="open = false" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========================================== --}}
{{-- SECTION NEWSLETTER                         --}}
{{-- ========================================== --}}
<section class="py-12 bg-brand-orange relative overflow-hidden">
    <div class="container mx-auto px-4 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 flex flex-col lg:flex-row items-center gap-12">
            
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Restez connecté à <span class="text-brand-white">la Plateforme</span> <span class="text-brand-orange">Une Seule Santé</span></h2>
                <p class="text-gray-600 text-lg">
                    Recevez directement dans votre boîte mail nos dernières publications, rapports d'activités et annonces officielles.
                </p>
            </div>

            <div class="w-full lg:w-1/2">
                <form action="{{ route('subscribe') }}" method="POST" class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <div>
                            <label for="home_name" class="sr-only">Nom complet</label>
                            <input type="text" id="home_name" name="name" required placeholder="Votre nom complet" 
                                   class="w-full px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:border-transparent transition">
                        </div>

                        <div>
                            <label for="home_email" class="sr-only">Adresse Email</label>
                            <input type="email" id="home_email" name="email" required placeholder="Votre adresse email" 
                                   class="w-full px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:border-transparent transition">
                        </div>

                        <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3 rounded-lg hover:bg-gray-800 transition transform hover:scale-[1.02] shadow-md">
                            Je m'abonne gratuitement
                        </button>
                    </div>
                </form>
                <p class="text-xs text-gray-400 mt-4 text-center">
                    Nous respectons votre vie privée. Désinscription possible à tout moment.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ========================================== --}}
{{-- NOTIFICATIONS FLASH                        --}}
{{-- ========================================== --}}
@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" 
         class="fixed bottom-5 right-5 z-[100] bg-green-600 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-4 animate-bounce-up">
        
        <div class="bg-white/20 p-2 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>

        <div>
            <h4 class="font-bold text-lg">Succès !</h4>
            <p class="text-sm">{{ session('success') }}</p>
        </div>

        <button @click="show = false" class="text-white/70 hover:text-white ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
@endif

@if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" 
         class="fixed bottom-5 right-5 z-[100] bg-red-600 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-4">
        <div>
            <h4 class="font-bold text-lg">Erreur</h4>
            <p class="text-sm">{{ session('error') }}</p>
        </div>
    </div>
@endif

</x-layout>