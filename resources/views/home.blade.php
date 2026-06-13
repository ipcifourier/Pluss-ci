<x-layout>

    {{-- ========================================== --}}
    {{-- SECTION BANDE D'ANNONCE (FLASH INFO)       --}}
    {{-- ========================================== --}}
    @if (isset($flashInfos) && $flashInfos->count() > 0)
        <div
            class="bg-gray-900 text-white relative overflow-hidden h-12 md:h-10 flex items-center border-b border-gray-800">

            {{-- Label Fixe à gauche --}}
            <div
                class="bg-brand-orange text-white text-[11px] md:text-xs font-bold uppercase px-3 md:px-4 h-full flex items-center z-20 shadow-md">
                <span class="animate-pulse mr-2">●</span> Flash Info
            </div>

            {{-- Le contenu défilant --}}
            <div class="flex-1 overflow-hidden relative h-full flex items-center">
                <div class="whitespace-nowrap animate-marquee hover:[animation-play-state:paused] flex items-center">

                    {{-- BOUCLE 1 --}}
                    @foreach ($flashInfos as $info)
                        <span class="mx-3 md:mx-6 text-xs md:text-sm flex items-center">
                            <span class="text-brand-orange mr-2">[{{ $info->created_at->format('d/m') }}]</span>
                            <a href="{{ route('articles.show', $info->slug) }}"
                                class="hover:text-brand-orange transition">
                                {{ $info->title }}
                            </a>
                        </span>
                        <span class="text-gray-600">|</span>
                    @endforeach

                    {{-- BOUCLE 2 (Duplication pour fluidité) --}}
                    @foreach ($flashInfos as $info)
                        <span class="mx-6 text-sm flex items-center">
                            <span class="text-brand-orange mr-2">[{{ $info->created_at->format('d/m') }}]</span>
                            <a href="{{ route('articles.show', $info->slug) }}"
                                class="hover:text-brand-orange transition">
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
    <div x-data="{
        activeSlide: 0,
        slides: [
            '/images/famille.jpg',
            '/images/presentation.jpg',
            '/images/travaux.jpg',
            '/images/logo.png'
        ],
        timer: null
    }" x-init="timer = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 6000)"
        class="relative w-full h-72 sm:h-96 md:h-[480px] lg:h-[580px] flex items-center justify-center overflow-hidden bg-gray-900">

        {{-- Images --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index"
                x-transition:enter="transition ease-in-out duration-1000"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in-out duration-1000"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-105"
                class="absolute inset-0 w-full h-full">
                <img :src="slide" class="w-full h-full object-cover" alt="Bannière PLUSS-CI">
            </div>
        </template>

        {{-- Overlay dégradé léger --}}
        <div class="absolute inset-0 z-10" style="background: linear-gradient(135deg, rgba(10,92,65,0.72) 0%, rgba(29,158,117,0.45) 50%, rgba(0,0,0,0.30) 100%);"></div>
        {{-- Bande basse pour lisibilité --}}
        <div class="absolute bottom-0 left-0 right-0 h-32 z-10" style="background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 100%);"></div>

        {{-- Motif décoratif --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.04] pointer-events-none z-10" xmlns="http://www.w3.org/2000/svg">
            <defs><pattern id="hero-dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1.5" fill="white"/></pattern></defs>
            <rect width="100%" height="100%" fill="url(#hero-dots)"/>
        </svg>

        {{-- Contenu central --}}
        <div class="relative z-20 text-center px-4 sm:px-8 max-w-5xl mx-auto w-full">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm border border-white/25 text-white text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                Côte d'Ivoire — Approche Une Seule Santé
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight drop-shadow-xl mb-4">
                Plateforme <span style="color:#FFB347;">Une Seule Santé</span>
            </h1>

            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-white/85 font-light max-w-2xl mx-auto leading-relaxed mb-8">
                Interconnexion des systèmes de santé pour une veille sanitaire optimale en Côte d'Ivoire.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="#actualites"
                    class="inline-flex items-center gap-2 bg-brand-orange text-white font-bold px-7 py-3 rounded-full shadow-xl hover:bg-orange-500 hover:scale-105 transition-all duration-300 text-sm sm:text-base">
                    Découvrir nos activités
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('presentation.biographie') }}"
                    class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm border border-white/30 text-white font-semibold px-7 py-3 rounded-full hover:bg-white/25 transition-all duration-300 text-sm sm:text-base">
                    En savoir plus
                </a>
            </div>
        </div>

        {{-- Flèches navigation --}}
        <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length; clearInterval(timer); timer = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 6000)"
            class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 bg-white/20 backdrop-blur-sm hover:bg-white/40 border border-white/30 text-white rounded-full flex items-center justify-center transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="activeSlide = (activeSlide + 1) % slides.length; clearInterval(timer); timer = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 6000)"
            class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 bg-white/20 backdrop-blur-sm hover:bg-white/40 border border-white/30 text-white rounded-full flex items-center justify-center transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- Indicateurs --}}
        <div class="absolute bottom-5 left-0 right-0 z-30 flex justify-center gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    @click="activeSlide = index; clearInterval(timer); timer = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 6000)"
                    class="h-1.5 rounded-full transition-all duration-500 border-0"
                    :class="activeSlide === index ? 'bg-brand-orange w-8' : 'bg-white/50 hover:bg-white/80 w-3'"></button>
            </template>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- SECTION LEADERSHIP / BIOGRAPHIE            --}}
    {{-- ========================================== --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0a5c41 0%, #1D9E75 60%, #25b585 100%);">

        {{-- Motif décoratif --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.06] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <defs><pattern id="lead-grid" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.8"/></pattern></defs>
            <rect width="100%" height="100%" fill="url(#lead-grid)"/>
        </svg>
        <div class="absolute -right-32 -top-32 w-96 h-96 rounded-full bg-white/5 pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-72 h-72 rounded-full bg-white/5 pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-stretch min-h-[420px]">

                {{-- PHOTO --}}
                <div class="w-full lg:w-5/12 flex items-end justify-center lg:justify-start pt-10 lg:pt-0">
                    <div class="relative w-64 sm:w-72 lg:w-80 xl:w-96">
                        {{-- Cadre décoratif derrière --}}
                        <div class="absolute -bottom-0 -left-4 w-full h-full rounded-2xl border-2 border-white/20"></div>
                        <div class="absolute -bottom-0 -left-8 w-full h-full rounded-2xl border border-white/10"></div>
                        {{-- Photo --}}
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl" style="aspect-ratio:3/4;">
                            <img src="{{ asset('images/cordo.png') }}" alt="Dr Djénéba OUATTARA"
                                class="w-full h-full object-cover object-top">
                            {{-- Overlay bas --}}
                            <div class="absolute bottom-0 left-0 right-0 p-5" style="background: linear-gradient(to top, rgba(10,92,65,0.95) 0%, transparent 100%);">
                                <p class="text-white font-extrabold text-base leading-tight">Dr Djénéba N'gnôh OUATTARA</p>
                                <p class="text-white/70 text-xs font-medium mt-0.5 uppercase tracking-wider">Conseillère du Premier Ministre</p>
                                <div class="flex items-center gap-1.5 mt-2">
                                    <span class="w-4 h-0.5 bg-white/50 rounded-full"></span>
                                    <p class="text-white/60 text-[11px]">Coordinatrice PLUSS-CI</p>
                                </div>
                            </div>
                        </div>
                        {{-- Badge médaille --}}
                        <div class="absolute -top-3 -right-3 w-14 h-14 rounded-full bg-white shadow-xl flex flex-col items-center justify-center">
                            <svg class="w-6 h-6" fill="#1D9E75" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <p class="text-[8px] font-bold text-gray-500 uppercase leading-tight text-center mt-0.5">Chevalier</p>
                        </div>
                    </div>
                </div>

                {{-- CONTENU --}}
                <div class="w-full lg:w-7/12 flex flex-col justify-center py-10 lg:py-16 px-0 lg:px-12 xl:px-16">

                    {{-- Label --}}
                    <div class="inline-flex items-center gap-2 mb-5">
                        <span class="w-8 h-0.5 bg-white/50 rounded-full"></span>
                        <span class="text-white/70 text-xs font-bold uppercase tracking-widest">Leadership & Vision</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                        L'Excellence au service<br>
                        <span style="color:#FFB347;">de la population</span>
                    </h2>

                    {{-- Citation --}}
                    <blockquote class="relative mb-6">
                        <svg class="absolute -top-2 -left-1 w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        <p class="text-white/90 text-base sm:text-lg leading-relaxed pl-8 italic font-light">
                            Notre mission est de transformer les défis complexes en opportunités de santé durable. Nous nous engageons à œuvrer pour le bien-être de chaque citoyen en Côte d'Ivoire.
                        </p>
                    </blockquote>

                    {{-- Capsule infos --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-8">
                        @foreach([
                            ['25+', "Années d'expérience"],
                            ['PhD', 'Santé Publique'],
                            ['2019', 'Création PLUSS-CI'],
                        ] as [$val, $label])
                        <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl px-4 py-3 text-center">
                            <div class="text-white font-extrabold text-xl">{{ $val }}</div>
                            <div class="text-white/65 text-xs mt-0.5">{{ $label }}</div>
                        </div>
                        @endforeach
                    </div>

                    {{-- CTA --}}
                    @if (Route::has('presentation.biographie'))
                        <div>
                            <a href="{{ route('presentation.biographie') }}"
                                class="inline-flex items-center gap-2 bg-white text-[#0a5c41] font-bold px-7 py-3 rounded-full shadow-xl hover:bg-gray-100 hover:scale-105 transition-all duration-300 text-sm sm:text-base">
                                Lire la biographie complète
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION HISTORIQUE DYNAMIQUE               --}}
    {{-- ========================================== --}}
    @if (isset($histories) && $histories->count() > 0)
        <section class="py-8 md:py-10 bg-gray-50 relative">
            <div class="w-full max-w-5xl mx-auto px-3 sm:px-4">

                <div class="text-center mb-6 md:mb-8">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-brand-orange px-2">Historique de la
                        Plateforme Une Seule Santé</h2>
                    <div class="w-14 h-1 mx-auto mt-3 rounded-full bg-brand-orange opacity-60"></div>
                </div>

                <div x-data="{ activeYear: {{ $histories->first()->year }} }" class="w-full">

                    {{-- ONGLETS --}}
                    <div class="flex justify-center items-end flex-wrap overflow-x-auto gap-1">
                        @foreach ($histories as $history)
                            <button @click="activeYear = {{ $history->year }}"
                                class="px-4 md:px-7 py-2 md:py-3 font-bold text-sm md:text-lg transition-all duration-300 relative border-2 border-b-0 -mb-[2px] rounded-t-xl whitespace-nowrap"
                                :class="activeYear === {{ $history->year }} ?
                                    'border-brand-orange text-brand-orange bg-white z-10 shadow-md' :
                                    'border-transparent text-gray-400 hover:text-brand-orange z-0'">
                                {{ $history->year }}
                                <div x-show="activeYear === {{ $history->year }}"
                                    class="absolute bottom-[-2px] left-0 right-0 h-[4px] bg-white"></div>
                            </button>
                        @endforeach
                    </div>

                    {{-- CONTENU --}}
                    <div class="border-2 border-brand-orange p-4 md:p-8 bg-white relative z-0 shadow-xl rounded-b-2xl rounded-tr-2xl">
                        @foreach ($histories as $history)
                            <div x-show="activeYear === {{ $history->year }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="prose prose-orange max-w-none text-gray-700" x-cloak style="display: none;">
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
    @if (isset($stats))
        <section class="bg-brand-green py-8 md:py-10">
            <div class="w-full max-w-7xl mx-auto px-3 sm:px-4">
                <div
                    class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 text-center text-white divide-x divide-white/20">
                    <div>
                        <div class="text-2xl md:text-4xl font-bold mb-1">{{ $stats['gtts'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm uppercase tracking-wide opacity-80">Groupes de Travail</div>
                    </div>
                    <div>
                        <div class="text-2xl md:text-4xl font-bold mb-1">{{ $stats['articles'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm uppercase tracking-wide opacity-80">Articles Publiés</div>
                    </div>
                    <div>
                        <div class="text-2xl md:text-4xl font-bold mb-1">{{ $stats['documents'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm uppercase tracking-wide opacity-80">Documents Publics</div>
                    </div>
                    <div>
                        <div class="text-2xl md:text-4xl font-bold mb-1">4</div>
                        <div class="text-xs md:text-sm uppercase tracking-wide opacity-80">Domaines d'action</div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================================== --}}
    {{-- SECTION GTT À LA UNE (LINKS ACTIVÉS)       --}}
    {{-- ========================================== --}}
    @if (isset($featuredGtts) && $featuredGtts->count() > 0)
        <section class="py-8 md:py-12 bg-gray-50">
            <div class="w-full max-w-7xl mx-auto px-3 sm:px-4">
                <div class="text-center mb-10 md:mb-16">
                    <span
                        class="text-brand-orange font-bold uppercase tracking-widest text-xs md:text-sm">Collaboration</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mt-2 px-2">Groupes de
                        Travail Technique</h2>
                    <div class="w-24 h-1 bg-gray-300 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach ($featuredGtts as $gtt)
                        <div
                            class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group border border-gray-100 flex flex-col h-full">

                            {{-- IMAGE --}}
                            <div class="h-40 bg-gray-200 overflow-hidden relative">
                                @if ($gtt->cover_image)
                                    <img src="{{ asset('images/' . $gtt->cover_image) }}" alt="{{ $gtt->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="font-bold text-lg text-gray-800 mb-2 group-hover:text-brand-orange transition line-clamp-2">
                                    {{ $gtt->name }}
                                </h3>

                                <p class="text-sm text-gray-500 mb-4 line-clamp-3 flex-grow">
                                    {{ Str::limit(strip_tags($gtt->description), 120) }}
                                </p>

                                <a href="{{ route('gtts.show', $gtt) }}"
                                    class="text-sm font-bold text-brand-green hover:underline mt-auto flex items-center gap-1">
                                    En savoir plus
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-8 md:mt-10">
                    <a href="{{ route('gtts.index') }}"
                        class="inline-block border-2 border-brand-orange text-brand-orange font-bold px-6 py-2 text-sm md:text-base rounded-full hover:bg-brand-orange hover:text-white transition">
                        Voir tous les GTT
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ========================================== --}}
    {{-- SECTION DOMAINES (DYNAMIQUE)               --}}
    {{-- ========================================== --}}

    {{-- Styles pour le contenu HTML généré par Filament dans les modales --}}
    <style>
        /* Titres de section : h2 contenant strong > em */
        .domaine-content h2 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            font-weight: 700;
            color: #0a5c41;
            background: linear-gradient(90deg, #f0fdf4, transparent);
            border-left: 3px solid #1D9E75;
            padding: 0.5rem 0.75rem;
            border-radius: 0 0.5rem 0.5rem 0;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .domaine-content h2 strong,
        .domaine-content h2 em {
            font-style: normal;
            font-weight: inherit;
            color: inherit;
        }
        /* Listes ordonnées : chaque <li> comme une carte */
        .domaine-content ol {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .domaine-content ol > li {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
        }
        .domaine-content ol > li p {
            margin: 0 0 0.5rem 0;
            font-size: 0.8375rem;
            color: #4b5563;
            line-height: 1.65;
        }
        .domaine-content ol > li p:last-child { margin-bottom: 0; }
        /* Label "Cibles", "Effet souhaité", "Mesure des cibles" → badge vert */
        .domaine-content ol > li p > strong:first-child {
            display: inline-block;
            background: #dcfce7;
            color: #0a5c41;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 0.15rem 0.55rem;
            border-radius: 9999px;
            margin-right: 0.35rem;
            vertical-align: middle;
            white-space: nowrap;
        }
        /* Listes non ordonnées */
        .domaine-content ul {
            padding-left: 1.25rem;
            margin: 0.5rem 0;
        }
        .domaine-content ul > li {
            font-size: 0.85rem;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 0.25rem;
            padding-left: 0.25rem;
        }
        .domaine-content ul > li::marker { color: #1D9E75; }
        /* Paragraphes hors liste */
        .domaine-content > p {
            font-size: 0.875rem;
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 0.75rem;
        }
        /* Texte en gras générique */
        .domaine-content strong { color: #374151; }
        /* Espace avant le premier h2 */
        .domaine-content h2:first-child { margin-top: 0; }

        /* ---- Structure TABLE (DETECTION, RIPOSTE, AUTRES RISQUES) ---- */
        /* Neutraliser le tableau et afficher chaque <td> comme une carte */
        .domaine-content table {
            display: block;
            width: 100%;
            border: none;
            border-spacing: 0;
        }
        .domaine-content tbody,
        .domaine-content tr {
            display: block;
        }
        .domaine-content td {
            display: block;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            margin-bottom: 0.5rem;
            vertical-align: top;
        }
        .domaine-content td h2,
        .domaine-content td h3 {
            margin-top: 0;
        }
        .domaine-content td p {
            margin: 0 0 0.5rem 0;
            font-size: 0.8375rem;
            color: #4b5563;
            line-height: 1.65;
        }
        .domaine-content td p:last-child { margin-bottom: 0; }
        /* Badges labels dans les <td> (même règle que dans les <li>) */
        .domaine-content td p > strong:first-child {
            display: inline-block;
            background: #dcfce7;
            color: #0a5c41;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 0.15rem 0.55rem;
            border-radius: 9999px;
            margin-right: 0.35rem;
            vertical-align: middle;
            white-space: nowrap;
        }
    </style>

    <section class="py-8 md:py-12 bg-white" x-data="{ selectedDomaine: null, modalOpen: false }">
        <div class="w-full max-w-7xl mx-auto px-3 sm:px-4">
            <div class="text-center mb-10 md:mb-16">
                <span class="text-brand-orange font-bold uppercase tracking-widest text-xs md:text-sm">Notre
                    Expertise</span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mt-2 px-2">Nos Domaines
                    d'Intervention</h2>
                <div class="w-24 h-1 bg-gray-200 mx-auto mt-4 rounded-full"></div>
            </div>

            @php
                $domaineStyles = [
                    'PREVENTION' => [
                        'bg'       => 'bg-green-50 hover:bg-green-100',
                        'iconBg'   => 'bg-green-100',
                        'iconColor'=> 'text-green-600',
                        'svg'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                    ],
                    'DETECTION' => [
                        'bg'       => 'bg-blue-50 hover:bg-blue-100',
                        'iconBg'   => 'bg-blue-100',
                        'iconColor'=> 'text-blue-600',
                        'svg'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a4 4 0 11-8 0 4 4 0 018 0z"/>',
                    ],
                    'RIPOSTE' => [
                        'bg'       => 'bg-red-50 hover:bg-red-100',
                        'iconBg'   => 'bg-red-100',
                        'iconColor'=> 'text-red-600',
                        'svg'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                    ],
                    'AUTRES RISQUES' => [
                        'bg'       => 'bg-orange-50 hover:bg-orange-100',
                        'iconBg'   => 'bg-orange-100',
                        'iconColor'=> 'text-orange-500',
                        'svg'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
                    ],
                ];
                $defaultStyle = [
                    'bg'       => 'bg-gray-50 hover:bg-gray-100',
                    'iconBg'   => 'bg-gray-100',
                    'iconColor'=> 'text-brand-orange',
                    'svg'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>',
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
                @foreach ($domaines as $domaine)
                    @php
                        $style = $domaineStyles[strtoupper(trim($domaine->titre))] ?? $defaultStyle;
                    @endphp
                    <div @click="selectedDomaine = {{ Js::from([
                        'titre' => $domaine->titre,
                        'icone' => $domaine->icone,
                        'image' => $domaine->image_couverture ? asset('images/' . $domaine->image_couverture) : null,
                        'description_courte' => $domaine->description_courte,
                        'contenu' => $domaine->contenu,
                    ]) }}; modalOpen = true"
                        class="cursor-pointer group p-4 md:p-8 rounded-lg md:rounded-2xl {{ $style['bg'] }} hover:shadow-xl transition duration-300 border border-transparent hover:border-gray-100 text-center">

                        {{-- Icône --}}
                        <div class="w-16 h-16 mx-auto {{ $style['iconBg'] }} rounded-full flex items-center justify-center shadow-md mb-6 group-hover:scale-110 transition duration-300">
                            @if ($domaine->icone)
                                <i class="{{ $domaine->icone }} {{ $style['iconColor'] }} text-2xl"></i>
                            @else
                                <svg class="w-8 h-8 {{ $style['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $style['svg'] !!}
                                </svg>
                            @endif
                        </div>

                        {{-- Titre --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $domaine->titre }}</h3>

                        {{-- Description courte (optionnelle) --}}
                        @if ($domaine->description_courte)
                            <p class="text-gray-600 text-sm line-clamp-3">{{ $domaine->description_courte }}</p>
                        @endif

                        {{-- Tooltip au survol --}}
                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-flex items-center gap-1.5 bg-brand-green/10 text-brand-green text-xs font-semibold px-3 py-1 rounded-full">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Cliquez pour plus d'infos
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- MODALE DE DÉTAIL --}}
            <div x-show="modalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" x-transition.opacity>

                {{-- Overlay --}}
                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="modalOpen = false"></div>

                <div class="relative min-h-screen flex items-center justify-center p-2 sm:p-4">
                    <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                        @click.stop>

                        <template x-if="selectedDomaine">
                            <div>
                                {{-- EN-TÊTE COLORÉ --}}
                                <div class="relative rounded-t-2xl overflow-hidden" style="background: linear-gradient(135deg, #0a5c41 0%, #1D9E75 100%);">
                                    {{-- Image de couverture en arrière-plan si disponible --}}
                                    <template x-if="selectedDomaine.image">
                                        <img :src="selectedDomaine.image" :alt="selectedDomaine.titre"
                                            class="absolute inset-0 w-full h-full object-cover opacity-20">
                                    </template>

                                    <div class="relative z-10 p-6 sm:p-8">
                                        {{-- Bouton fermer --}}
                                        <button @click="modalOpen = false"
                                            class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 text-white transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>

                                        {{-- Icône + Titre --}}
                                        <div class="flex items-center gap-4">
                                            <div x-show="selectedDomaine.icone"
                                                class="shrink-0 w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center">
                                                <i :class="selectedDomaine.icone" class="text-white text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-1">Domaine d'intervention</p>
                                                <h2 class="text-2xl font-extrabold text-white leading-tight" x-text="selectedDomaine.titre"></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- CORPS --}}
                                <div class="p-6 sm:p-8">

                                    {{-- Description courte — callout --}}
                                    <div x-show="selectedDomaine.description_courte"
                                        class="flex gap-3 bg-brand-green/5 border border-brand-green/20 rounded-xl p-4 mb-6">
                                        <div class="shrink-0 mt-0.5">
                                            <svg class="w-5 h-5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-brand-green font-medium text-sm leading-relaxed" x-text="selectedDomaine.description_courte"></p>
                                    </div>

                                    {{-- Contenu détaillé (HTML Filament) --}}
                                    <div class="domaine-content" x-html="selectedDomaine.contenu"></div>

                                    {{-- Pied de modale --}}
                                    <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
                                        <button @click="modalOpen = false"
                                            class="inline-flex items-center gap-2 bg-brand-green hover:bg-green-700 text-white font-bold text-sm px-6 py-2.5 rounded-xl transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Fermer
                                        </button>
                                    </div>
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
    <section id="actualites" class="py-8 md:py-10 bg-gray-50">
        <div class="w-full max-w-7xl mx-auto px-3 sm:px-4">
            <div class="grid lg:grid-cols-3 gap-6 md:gap-8 lg:gap-12">

                {{-- COLONNE GAUCHE : Articles --}}
                <div class="lg:col-span-2">
                    <h2 class="text-xl md:text-2xl font-bold mb-6 md:mb-8 flex items-center gap-2">
                        <span class="text-brand-orange">●</span> Dernières Actualités
                    </h2>

                    @if (isset($latestArticles) && $latestArticles->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                            @foreach ($latestArticles as $article)
                                <article
                                    class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col border border-gray-100">
                                    <div class="h-48 bg-gray-200 overflow-hidden relative">
                                        @if ($article->image_path)
                                            <img src="{{ asset('images/' . $article->image_path) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-6 flex-grow flex flex-col">
                                        <div class="flex items-center text-xs text-gray-500 mb-2 gap-2">
                                            @if ($article->category)
                                                <span
                                                    class="bg-brand-orange/10 text-brand-orange px-2 py-1 rounded font-bold">{{ $article->category }}</span>
                                            @endif
                                            <span>{{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Récemment' }}</span>
                                        </div>
                                        <h3
                                            class="text-lg font-bold mb-3 text-gray-800 line-clamp-2 hover:text-brand-orange transition">
                                            <a href="{{ route('articles.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h3>
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="text-brand-green font-semibold mt-auto hover:underline text-sm flex items-center gap-1">
                                            Lire la suite
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
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

                    <div class="mt-6 md:mt-8 text-center md:text-left">
                        <a href="{{ route('articles.index') }}"
                            class="inline-flex items-center justify-center px-4 md:px-6 py-2 md:py-3 border border-gray-300 shadow-sm text-sm md:text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
                            Voir toutes les actualités
                        </a>
                    </div>
                </div>

                {{-- COLONNE DROITE : Sidebar (fusionnée et organisée) --}}
                <div class="space-y-6 md:space-y-8">

                    {{-- 1. SONDAGE --}}
                    @if (isset($poll))
                        <div
                            class="bg-white rounded-lg md:rounded-xl shadow-lg p-4 md:p-6 border-t-4 border-brand-orange">
                            <h3
                                class="text-base md:text-lg font-bold text-gray-900 mb-3 md:mb-4 flex items-center gap-2">
                                <span class="text-xl">🗳️</span> Sondage
                            </h3>
                            <p class="text-gray-700 font-medium mb-4">{{ $poll->question }}</p>

                            @if (session('has_voted_' . $poll->id) || !$poll->is_active)
                                {{-- Résultats --}}
                                <div class="space-y-3">
                                    @php $totalVotes = $poll->total_votes; @endphp
                                    @foreach ($poll->options as $option)
                                        @php
                                            $votes = $option['votes'] ?? 0;
                                            $label = $option['label'] ?? ($option['answer'] ?? 'Option');
                                            $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100) : 0;
                                        @endphp
                                        <div>
                                            <div class="flex justify-between text-xs mb-1">
                                                <span>{{ $label }}</span>
                                                <span class="font-bold">{{ $percentage }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-brand-orange h-2 rounded-full"
                                                    @style(['width: '.$percentage.'%'])></div>
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
                                    @foreach ($poll->options as $index => $option)
                                        @php $label = $option['label'] ?? $option['answer'] ?? 'Option'; @endphp
                                        <label
                                            class="flex items-center space-x-3 p-3 rounded-lg border border-gray-100 hover:bg-orange-50 cursor-pointer transition">
                                            <input type="radio" name="option_index" value="{{ $index }}"
                                                class="text-brand-orange focus:ring-brand-orange h-4 w-4" required>
                                            <span class="text-sm text-gray-700">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                    <button type="submit"
                                        class="w-full bg-gray-900 text-white py-2 rounded-lg font-bold hover:bg-gray-800 transition mt-2 text-sm">
                                        Voter
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif

                    {{-- 2. BIBLIOTHÈQUE DE DOCUMENTS --}}
                    <div
                        class="bg-white rounded-lg md:rounded-xl shadow-lg border-t-4 border-brand-green p-4 md:p-6 relative overflow-hidden group">

                        {{-- Décoration d'arrière-plan --}}
                        <div
                            class="absolute -right-6 -top-6 text-gray-50 group-hover:text-green-50 transition duration-500">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4 19h6v-2H4v2zm20 0h-6v-2h6v2zm-8 2h6v-2h-6v2zm-8 0h6v-2H8v2zm8-4h6v-2h-6v2zm-8 0h6v-2H8v2zm8-4h6v-2h-6v2zm-8 0h6v-2H8v2zM4 9v2h16V9H4zm0 4h16v-2H4v2zM4 5v2h16V5H4z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <span class="text-brand-green">📂</span> Bibliothèque de documents
                            </h3>
                            <p class="text-gray-600 text-sm mb-6">
                                Accédez à notre base documentaire complète : rapports, arrêtés, bulletins
                                épidémiologiques et guides techniques.
                            </p>

                            <a href="{{ route('documents.index') }}"
                                class="block w-full text-center bg-brand-green text-white font-bold py-2 md:py-3 text-sm md:text-base rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg transition transform hover:-translate-y-1">
                                Consulter la Bibliothèque
                            </a>
                            <div class="text-center mt-2">
                                <span class="text-[10px] text-gray-400 uppercase tracking-wider">Avec filtres de
                                    recherche</span>
                            </div>
                        </div>
                    </div>

                    {{-- 3. DOCUMENTS RÉCENTS --}}
                    @if (isset($latestDocuments) && $latestDocuments->count() > 0)
                        <div class="bg-white rounded-lg md:rounded-xl shadow-sm border border-gray-100 p-4 md:p-6">
                            <h3
                                class="text-base md:text-lg font-bold text-gray-900 mb-3 md:mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Publications récentes
                            </h3>
                            <ul class="space-y-3">
                                @foreach ($latestDocuments as $doc)
                                    <li class="pb-3 border-b border-gray-50 last:border-0">
                                        <a href="{{ route('documents.download', $doc) }}" class="group block">
                                            <span
                                                class="text-sm font-semibold text-gray-700 group-hover:text-brand-orange transition line-clamp-1">{{ $doc->title }}</span>
                                            <div class="flex justify-between items-center mt-1">
                                                <span class="text-xs text-gray-400">{{ $doc->type }}</span>
                                                <span
                                                    class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded group-hover:bg-brand-orange group-hover:text-white transition">PDF</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- 4. ACCÈS RAPIDE (ESPACE PRO) --}}
                    <div
                        class="bg-brand-green text-white p-4 md:p-6 rounded-lg md:rounded-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 opacity-10 transform translate-x-10 -translate-y-10">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-base md:text-lg mb-2 relative z-10">Espace Professionnel</h3>
                        <p class="text-green-100 text-xs md:text-sm mb-3 md:mb-4 relative z-10">Accès réservé aux
                            membres des groupes de travail et partenaires.</p>
                        <a href="/admin/login"
                            class="inline-block bg-white text-brand-green px-4 py-2 rounded-lg text-xs md:text-sm font-bold shadow-lg hover:bg-gray-100 transition relative z-10">
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
    @if (isset($medias) && $medias->count() > 0)
        <section class="py-8 md:py-10 bg-white border-t border-gray-100">
            <div class="w-full max-w-7xl mx-auto px-3 sm:px-4">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 px-2">Notre Médiathèque</h2>
                    <div class="w-20 h-1 bg-brand-orange mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
                    @foreach ($medias as $media)
                        <div x-data="{ open: false, current: 0 }"
                            class="bg-white rounded-lg md:rounded-xl shadow-lg overflow-hidden border border-gray-100 group">
                            <div @click="open = true" class="cursor-pointer relative h-48 overflow-hidden">
                                @if ($media->cover_image)
                                    <img src="{{ asset('images/' . $media->cover_image) }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition transform scale-0 group-hover:scale-100"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="p-4 md:p-5">
                                <h3 class="font-bold text-gray-800 text-base md:text-lg mb-3 line-clamp-1">
                                    {{ $media->title }}</h3>
                                <button @click="open = true"
                                    class="w-full text-center bg-gray-50 hover:bg-gray-900 hover:text-white text-gray-700 font-semibold py-2 rounded-lg transition duration-300">
                                    Voir le média
                                </button>
                            </div>

                            {{-- MODALE --}}
                            <div x-show="open" style="display: none;"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 p-2 sm:p-4 backdrop-blur-sm"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <div @click.away="open = false"
                                    class="bg-white rounded-lg sm:rounded-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto relative shadow-2xl">
                                    <button @click="open = false"
                                        class="absolute top-2 sm:top-4 right-2 sm:right-4 z-10 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full p-2 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <div class="p-4 sm:p-6 md:p-8">
                                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 md:mb-6 pr-10">
                                            {{ $media->title }}</h3>
                                        @if ($media->embed_url)
                                            <div
                                                class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden shadow-lg">
                                                <template x-if="open">
                                                    <iframe src="{{ $media->embed_url }}" title="Video player"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen class="w-full h-full"></iframe>
                                                </template>
                                            </div>
                                        @elseif($media->audio_file)
                                            <audio controls class="w-full">
                                                <source src="{{ asset('images/' . $media->audio_file) }}"
                                                    type="audio/mpeg">
                                            </audio>
                                        @elseif($media->cover_image)
                                            {{-- AFFICHAGE DE L'IMAGE POUR LES ALBUMS --}}
                                            @php
                                                $allPhotos = [];
                                                if ($media->gallery_images && count($media->gallery_images) > 0) {
                                                    $allPhotos = $media->gallery_images;
                                                } else {
                                                    $allPhotos = [$media->cover_image];
                                                }
                                            @endphp
                                            <div x-data="{ photos: {{ json_encode(array_values($allPhotos)) }}, current: 0 }">
                                                {{-- Image principale --}}
                                                <div class="relative bg-gray-900 rounded-xl overflow-hidden shadow-lg flex justify-center items-center" style="min-height:300px;">
                                                    <template x-for="(photo, index) in photos" :key="index">
                                                        <img
                                                            :src="'{{ asset('images/') }}/' + photo"
                                                            x-show="current === index"
                                                            class="max-w-full h-auto max-h-[55vh] object-contain rounded-lg mx-auto"
                                                            x-transition:enter="transition ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-95"
                                                            x-transition:enter-end="opacity-100 scale-100"
                                                        >
                                                    </template>

                                                    {{-- Flèches navigation (seulement si > 1 photo) --}}
                                                    <template x-if="photos.length > 1">
                                                        <div>
                                                            <button @click="current = (current - 1 + photos.length) % photos.length"
                                                                class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-black/50 hover:bg-black/80 text-white rounded-full flex items-center justify-center transition z-10">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                                            </button>
                                                            <button @click="current = (current + 1) % photos.length"
                                                                class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-black/50 hover:bg-black/80 text-white rounded-full flex items-center justify-center transition z-10">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                            </button>
                                                            {{-- Compteur --}}
                                                            <div class="absolute bottom-2 right-3 bg-black/60 text-white text-xs px-2 py-0.5 rounded-full z-10">
                                                                <span x-text="current + 1"></span> / <span x-text="photos.length"></span>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>

                                                {{-- Miniatures --}}
                                                <template x-if="photos.length > 1">
                                                    <div class="flex gap-2 mt-3 overflow-x-auto pb-1">
                                                        <template x-for="(photo, index) in photos" :key="index">
                                                            <img
                                                                :src="'{{ asset('images/') }}/' + photo"
                                                                @click="current = index"
                                                                :class="current === index ? 'ring-2 ring-brand-orange opacity-100' : 'opacity-50 hover:opacity-80'"
                                                                class="w-16 h-12 object-cover rounded-md cursor-pointer flex-shrink-0 transition"
                                                            >
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>
                                        @endif
                                        <div class="mt-4 text-right">
                                            <button @click="open = false"
                                                class="bg-gray-800 text-white px-6 py-2 text-sm md:text-base rounded-lg hover:bg-gray-700 transition">Fermer</button>
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
    <section class="py-8 md:py-12 bg-brand-orange relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-3 sm:px-4 relative z-10">
            <div
                class="bg-white rounded-lg md:rounded-2xl shadow-2xl p-6 md:p-8 lg:p-12 flex flex-col lg:flex-row items-center gap-6 md:gap-8 lg:gap-12">

                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-3 md:mb-4">Restez connecté à <span
                            class="text-brand-white">la Plateforme</span> <span class="text-brand-orange">Une Seule
                            Santé</span></h2>
                    <p class="text-gray-600 text-sm md:text-lg">
                        Recevez directement dans votre boîte mail nos dernières publications, rapports d'activités et
                        annonces officielles.
                    </p>
                </div>

                <div class="w-full lg:w-1/2">
                    <form action="{{ route('subscribe') }}" method="POST"
                        class="bg-gray-50 p-4 md:p-6 rounded-lg md:rounded-xl border border-gray-100">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <div>
                                <label for="home_name" class="sr-only">Nom complet</label>
                                <input type="text" id="home_name" name="name" required
                                    placeholder="Votre nom complet"
                                    class="w-full px-4 md:px-5 py-2 md:py-3 rounded-lg text-sm md:text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:border-transparent transition">
                            </div>

                            <div>
                                <label for="home_email" class="sr-only">Adresse Email</label>
                                <input type="email" id="home_email" name="email" required
                                    placeholder="Votre adresse email"
                                    class="w-full px-4 md:px-5 py-2 md:py-3 rounded-lg text-sm md:text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:border-transparent transition">
                            </div>

                            <button type="submit"
                                class="w-full bg-gray-900 text-white font-bold py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-gray-800 transition transform hover:scale-[1.02] shadow-md">
                                Je m'abonne gratuitement
                            </button>
                        </div>
                    </form>
                    <p class="text-xs text-gray-400 mt-3 md:mt-4 text-center px-2">
                        Nous respectons votre vie privée. Désinscription possible à tout moment.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- NOTIFICATIONS FLASH                        --}}
    {{-- ========================================== --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
            class="fixed bottom-5 right-5 z-[100] bg-green-600 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-4 animate-bounce-up">

            <div class="bg-white/20 p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div>
                <h4 class="font-bold text-lg">Succès !</h4>
                <p class="text-sm">{{ session('success') }}</p>
            </div>

            <button @click="show = false" class="text-white/70 hover:text-white ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
            class="fixed bottom-5 right-5 z-[100] bg-red-600 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-4">
            <div>
                <h4 class="font-bold text-lg">Erreur</h4>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

</x-layout>
