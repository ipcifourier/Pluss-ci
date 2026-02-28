<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="text-2xl font-bold text-gray-800 tracking-wide">
                PLUSS<span class="text-brand-green">.CI</span>
            </span>
            <img src="{{ asset('images/logo.png') }}" alt="Logo PLUSS.CI" class="h-10 w-auto">
        </a>

        {{-- MENU NAVIGATION --}}
        <nav class="hidden md:flex space-x-8 items-center">
            
            <a href="{{ route('home') }}" class="font-medium hover:text-brand-orange {{ request()->routeIs('home') ? 'text-brand-orange' : 'text-gray-600' }}">
                Accueil
            </a>

            {{-- MENU DÉROULANT : PRÉSENTATION --}}
            <div class="relative group h-full flex items-center">
                <button class="flex items-center gap-1 font-medium text-gray-600 hover:text-brand-orange focus:outline-none transition py-4">
                    Présentation
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="absolute top-full left-0 w-64 bg-white border-t-4 border-brand-orange shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 rounded-b-lg overflow-hidden">
                    <div class="flex flex-col">
                        
                        <a href="{{ url('/page/mot-de-la-coordonnatrice') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">>Mot de la Coordonnatrice</a>
                        <a href="{{ route('pages.show', 'qui-sommes-nous') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                            <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span> Equipe de la Plateforme
                        </a>
                        <a href="{{ route('pages.show', 'notre-vision') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                            <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span> Notre Vision
                        </a>
                        <a href="{{ route('pages.show', 'nos-objectifs') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                            <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span> Nos Objectifs
                        </a>
                        <a href="{{ route('pages.show', 'nos-missions') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                            <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span> Nos Missions
                        </a>
                        <a href="{{ route('pages.show', 'nos-partenaires') }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                            <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span> Nos Partenaires
                        </a>
                    </div>
                </div>
            </div>

            {{-- MENU DÉROULANT : GTT --}}
            <div class="relative group h-full flex items-center">
                <button class="flex items-center gap-1 font-medium text-gray-600 hover:text-brand-orange focus:outline-none transition py-4">
                    Les GTT
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="absolute top-full left-0 w-64 bg-white border-t-4 border-brand-orange shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 rounded-b-lg overflow-hidden">
                    <div class="flex flex-col">
                        
                        {{-- Boucle dynamique pour les GTT (si disponible via AppServiceProvider) --}}
                        @if(isset($menuGtts))
                            @foreach($menuGtts as $gttMenu)
                                <a href="{{ route('gtts.show', $gttMenu) }}" class="px-6 py-4 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-orange transition border-b border-gray-100 last:border-0 flex items-center gap-3 group/item">
                                    <span class="w-2 h-2 rounded-full bg-gray-300 group-hover/item:bg-brand-orange transition"></span> {{ $gttMenu->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
           <a href="{{ route('evenements') }}" class="text-gray-900 hover:text-brand-orange px-3 py-2 font-medium transition">
            Évènements
            </a>
            <a href="{{ route('contact') }}" class="bg-brand-orange text-white px-4 py-2 rounded-lg font-bold hover:bg-orange-600 transition shadow-md">
                Contact
            </a>
            {{-- Petite barre de recherche intégrée au menu --}}
            <form action="{{ route('search') }}" method="GET" class="hidden lg:flex items-center relative mr-4">
                <input type="text" name="q" placeholder="Rechercher..." class="bg-gray-100 border-none rounded-full py-2 pl-4 pr-10 text-sm focus:ring-2 focus:ring-brand-orange w-48 transition-all duration-300 focus:w-64">
                <button type="submit" class="absolute right-3 text-gray-500 hover:text-brand-orange">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </nav>
    </div>
</header>