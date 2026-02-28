@props([
    'title' => 'PLUSS.CI - Plateforme Une Seule Santé Côte d\'Ivoire',
    'description' => 'Plateforme de coordination multisectorielle Une Seule Santé (One Health) pour la prévention et la riposte face aux urgences sanitaires.',
    'image' => null,
    'ogType' => 'website'
])

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ url()->current() }}">
    
    @if($image)
        <meta property="og:image" content="{{ asset('storage/' . $image) }}">
    @else
        <meta property="og:image" content="{{ asset('images/logo-pluss.png') }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    @if($image)
        <meta name="twitter:image" content="{{ asset('storage/' . $image) }}">
    @else
        <meta name="twitter:image" content="{{ asset('images/logo-pluss.png') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: '#F97316',
                            green: '#16A34A',
                            dark: '#1F2937',
                        }
                    }
                }
            }
        }
    </script>
    {{-- Alpine.js pour l'interactivité --}}
    <!--script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script-->
    
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    
<div class="max-w-[1440px] mx-auto bg-blue-200 shadow-2xl min-h-screen flex flex-col relative">

    {{-- Header avec menu burger --}}
    <header class="bg-white shadow-md sticky top-0 z-50" x-data="{ menuOpen: false }">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="text-2xl font-bold text-gray-800 tracking-wide">PLUSS.CI</span>
                <img src="{{ asset('images/logo.png') }}" alt="Logo PLUSS.CI" class="h-10 w-auto">
            </a>

            {{-- Navigation desktop (cachée sur mobile) --}}
            <nav class="hidden md:flex space-x-8 items-center">
                <!-- ... (navigation desktop existante) ... -->
                <a href="{{ route('home') }}" class="font-medium hover:text-brand-orange {{ request()->routeIs('home') ? 'text-brand-orange' : 'text-gray-600' }}">
                    Accueil
                </a>

                {{-- Menu Présentation (desktop) --}}
                <div class="relative group h-full flex items-center">
                    <button class="flex items-center gap-1 font-medium text-gray-600 hover:text-brand-orange focus:outline-none transition py-4">
                        Présentation
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 w-64 bg-white border-t-4 border-brand-orange shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 rounded-b-lg overflow-hidden">
                        <div class="flex flex-col">
                            <a href="{{ route('pages.show', ['slug' => 'mot-de-la-coordonnatrice']) }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                Mot de la Coordonnatrice
                            </a>
                            <a href="{{ route('presentation.equipe') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                L'équipe de la Plateforme
                            </a>
                            <a href="{{ route('pages.show', 'notre-vision') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                Notre Vision
                            </a>
                            <a href="{{ route('pages.show', 'nos-objectifs') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                Nos Objectifs
                            </a>
                            <a href="{{ route('pages.show', 'nos-missions') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                Nos Missions
                            </a>
                            <a href="{{ route('presentation.partenaires') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                Nos Partenaires
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Menu Les GTT (desktop) --}}
                <div class="relative group h-full flex items-center">
                    <button class="flex items-center gap-1 font-medium text-gray-600 hover:text-brand-orange focus:outline-none transition py-4">
                        Les GTT
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 w-64 bg-white border-t-4 border-brand-orange shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 rounded-b-lg overflow-hidden">
                        <div class="flex flex-col">
                            <a href="{{ route('gtts.show', 'generalites-sur-les-gtt') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                Généralités sur les GTT
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-surveillance-et-notifications') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Surveillance et Notifications
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-ressources-humaines') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Ressources Humaines
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-communication-des-risques') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Communication Des Risques
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-laboratoires') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Laboratoires
                            </a>
                           <a href="{{ route('gtts.show', 'gtt-prise-en-charge') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Prise en Charge
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-prevention-et-controle-des-infections') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Prévention et Contrôle des Infections
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-ram') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT RAM
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-urgences') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Urgences
                            </a>
                             <a href="{{ route('gtts.show', 'gtt-securite-sanitaire-des-aliments') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Sécurité Sanitaire des aliments
                            </a>
                            <a href="{{ route('gtts.show', 'gtt-recherche-et-innovation') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span>
                                GTT Recherche et Innovation
                            </a>
                        </div>
                    </div>
                </div>

                

                <a href="{{ route('zoonoses') }}" class="text-gray-900 hover:text-brand-orange px-3 py-2 font-medium transition">
                    Zoonoses Prioritaires
                </a>

                <a href="{{ route('evenements') }}" class="text-gray-900 hover:text-brand-orange px-3 py-2 font-medium transition">
                    Évènements
                </a>

                <a href="{{ route('contact') }}" class="bg-brand-orange text-white px-4 py-2 rounded-lg font-bold hover:bg-orange-600 transition shadow-md">
                    Contact
                </a>

                {{-- Barre de recherche desktop --}}
                <form action="{{ route('search') }}" method="GET" class="hidden lg:flex items-center relative mr-4">
                    <input type="text" name="q" placeholder="Rechercher..." class="bg-gray-100 border-none rounded-full py-2 pl-4 pr-10 text-sm focus:ring-2 focus:ring-brand-orange w-48 transition-all duration-300 focus:w-64">
                    <button type="submit" class="absolute right-3 text-gray-500 hover:text-brand-orange">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </nav>

            {{-- Bouton burger mobile --}}
            <button @click="menuOpen = !menuOpen" class="md:hidden focus:outline-none">
                <svg x-show="!menuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="menuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Menu mobile déroulant --}}
        <div x-show="menuOpen" @click.away="menuOpen = false" class="md:hidden bg-white border-t border-gray-200 shadow-lg absolute left-0 right-0 z-50" x-cloak>
            <div class="container mx-auto px-4 py-4 space-y-3 max-h-[80vh] overflow-y-auto">
                {{-- Accueil --}}
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-brand-orange font-medium">
                    Accueil
                </a>

                {{-- Section Présentation --}}
                <div x-data="{ open: false }" class="border-b border-gray-100 pb-2">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 text-gray-700 hover:text-brand-orange font-medium">
                        <span>Présentation</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="ml-4 mt-1 space-y-1">
                        <a href="{{ route('pages.show', ['slug' => 'mot-de-la-coordonnatrice']) }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            Mot de la Coordonnatrice
                        </a>
                        <a href="{{ route('presentation.equipe') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            L'équipe de la Plateforme
                        </a>
                        <a href="{{ route('pages.show', 'notre-vision') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            Notre Vision
                        </a>
                        <a href="{{ route('pages.show', 'nos-objectifs') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            Nos Objectifs
                        </a>
                        <a href="{{ route('pages.show', 'nos-missions') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            Nos Missions
                        </a>
                        <a href="{{ route('presentation.partenaires') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            Nos Partenaires
                        </a>
                    </div>
                </div>

                {{-- Section Les GTT --}}
                <div x-data="{ open: false }" class="border-b border-gray-100 pb-2">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 text-gray-700 hover:text-brand-orange font-medium">
                        <span>Les GTT</span>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="ml-4 mt-1 space-y-1 max-h-60 overflow-y-auto">
                        <a href="{{ route('gtts.show', 'generalites-sur-les-gtt') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            Généralités sur les GTT
                        </a>
                        
                        <a href="{{ route('gtts.show', 'gtt-surveillance-et-notifications') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Surveillance et Notifications
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-ressources-humaines') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Ressources Humaines
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-communication-des-risques') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Communication Des Risques
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-laboratoires') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Laboratoires
                        </a>

                        <a href="{{ route('gtts.show', 'gtt-prise-en-charge') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Prise en Charge
                        </a>
                        
                        <a href="{{ route('gtts.show', 'gtt-prevention-et-controle-des-infections') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Prévention et Contrôle des Infections
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-ram') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT RAM
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-urgences') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Urgences
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-securite-sanitaire-des-aliments') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Sécurité Sanitaire des Aliments
                        </a>
                        <a href="{{ route('gtts.show', 'gtt-recherche-et-innovation') }}" class="block py-2 text-sm text-gray-600 hover:text-brand-orange">
                            GTT Recherche et Innovation
                        </a>
                        
                        
                            
                    </div>
                </div>

                
                {{-- Zoonoses --}}
                <a href="{{ route('zoonoses') }}" class="block py-2 text-gray-700 hover:text-brand-orange font-medium">
                    Zoonoses Prioritaires
                </a>

                {{-- Évènements --}}
                <a href="{{ route('evenements') }}" class="block py-2 text-gray-700 hover:text-brand-orange font-medium">
                    Évènements
                </a>

                {{-- Contact --}}
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-brand-orange font-medium">
                    Contact
                </a>

                {{-- Barre de recherche mobile --}}
                <form action="{{ route('search') }}" method="GET" class="pt-2">
                    <div class="flex items-center bg-gray-100 rounded-full overflow-hidden">
                        <input type="text" name="q" placeholder="Rechercher..." class="flex-1 bg-transparent px-4 py-2 text-sm focus:outline-none">
                        <button type="submit" class="px-4 py-2 bg-brand-orange text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer (inchangé) --}}
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t-4 border-brand-orange">
    <div class="container mx-auto px-4">
        
        {{-- GRILLE : On passe de 3 à 4 colonnes sur grand écran --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            
            {{-- COLONNE 1 : LOGO & INFOS --}}
            <div>
                <h3 class="text-2xl font-bold mb-4 text-white">PLUSS.CI</h3>
                <p class="text-gray-400 leading-relaxed mb-6">
                    Plateforme Une Seule Santé Côte d'Ivoire. <br>
                    Ensemble pour une santé globale.
                </p>
                <div class="flex space-x-4">
                    {{-- Facebook --}}
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-brand-orange transition group">
                        <svg class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    {{-- LinkedIn --}}
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-brand-orange transition group">
                        <svg class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                </div>
            </div>

            {{-- COLONNE 2 : NAVIGATION --}}
            <div>
                <h4 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2 inline-block">Navigation</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Accueil</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Actualités</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Documents</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Contact</a></li>
                </ul>
            </div>

            {{-- COLONNE 3 (NOUVELLE) : LIENS UTILES --}}
            <div>
                <h4 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2 inline-block">Liens Utiles</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Ministère de la Santé</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Ressources Animales</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Environnement</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> OMS / FAO / OIE</a></li>
                </ul>
            </div>

            {{-- COLONNE 4 : NEWSLETTER --}}
            <div>
                <h4 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2 inline-block">Newsletter</h4>
                <p class="text-gray-400 text-sm mb-4">Abonnez-vous pour recevoir nos rapports et actualités.</p>
                
                <form action="{{ route('subscribe') }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    
                    {{-- Champ NOM --}}
                    <input type="text" name="name" required placeholder="Votre nom complet" 
                           class="bg-gray-800 border border-gray-700 text-white px-4 py-2 rounded focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition text-sm">
                    
                    {{-- Champ EMAIL --}}
                    <input type="email" name="email" required placeholder="Votre adresse email" 
                           class="bg-gray-800 border border-gray-700 text-white px-4 py-2 rounded focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition text-sm">
                    
                    {{-- Bouton --}}
                    <button type="submit" class="bg-brand-orange text-white px-4 py-2 rounded font-bold uppercase text-sm tracking-wide hover:bg-orange-600 hover:shadow-lg transition">
                        S'inscrire
                    </button>
                </form>
            </div>

        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} PLUSS.CI - Tous droits réservés.
        </div>
    </div>
</footer>
</div>

@livewireScripts

{{-- Style pour x-cloak (caché avant chargement Alpine) --}}
<style>
    [x-cloak] { display: none !important; }
</style>
</body>
</html>