<x-layout title="Nos Partenaires - PLUSS.CI">

    {{-- ========================================== --}}
    {{-- HERO — charte graphique teal               --}}
    {{-- ========================================== --}}
    <section class="relative text-white overflow-hidden" style="background: linear-gradient(135deg, #0a5c41 0%, #1D9E75 60%, #25b585 100%);">
        {{-- Motif décoratif --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="2" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots)"/>
            </svg>
        </div>
        {{-- Cercles décoratifs --}}
        <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full opacity-10" style="background:#25b585;"></div>
        <div class="absolute -bottom-10 -left-10 w-48 h-48 rounded-full opacity-10" style="background:#F97316;"></div>

        <div class="relative z-10 container mx-auto px-4 py-16 text-center">
            {{-- Fil d'Ariane --}}
            <div class="flex items-center justify-center gap-2 text-xs font-medium text-white/60 mb-6 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
                <span>/</span>
                <a href="{{ route('presentation.organigramme') }}" class="hover:text-white transition">Présentation</a>
                <span>/</span>
                <span class="text-white/90">Partenaires</span>
            </div>

            {{-- Icône centrale --}}
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/15 backdrop-blur mb-5 mx-auto">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>

            <span class="inline-block bg-brand-orange/20 text-brand-orange border border-brand-orange/30 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">
                Collaboration &amp; Synergie
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                Nos <span class="text-brand-orange">Partenaires</span>
            </h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto leading-relaxed">
                La mise en œuvre de l'approche <em>"Une Seule Santé"</em> est rendue possible grâce à l'engagement
                de nos partenaires nationaux et internationaux.
            </p>
            <div class="w-20 h-1 bg-brand-orange mx-auto mt-8 rounded-full"></div>
        </div>

        {{-- Vague de transition --}}
        <div class="relative h-12 -mb-1">
            <svg viewBox="0 0 1440 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 w-full" preserveAspectRatio="none">
                <path d="M0 48L1440 48L1440 0C1200 40 960 48 720 40C480 32 240 0 0 0L0 48Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- SECTION : GRILLE DES PARTENAIRES           --}}
    {{-- ========================================== --}}
    <section class="pt-4 pb-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-7xl">

            @if (isset($partners) && $partners->count() > 0)

                {{-- Compteur --}}
                <p class="text-sm text-gray-400 text-center mb-10">
                    {{ $partners->total() }} partenaire{{ $partners->total() > 1 ? 's' : '' }} au total
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach ($partners as $partner)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col group overflow-hidden">

                            {{-- Bandeau coloré en haut + logo --}}
                            <div class="relative h-40 flex items-center justify-center" style="background: linear-gradient(135deg, #f0fdf8, #dcfce7);">
                                {{-- Accent décoratif --}}
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-green to-brand-orange rounded-t-2xl"></div>

                                @if ($partner->logo_path)
                                    <img src="{{ asset('images/' . $partner->logo_path) }}"
                                        alt="Logo {{ $partner->name }}"
                                        class="max-h-24 max-w-[70%] object-contain grayscale group-hover:grayscale-0 transition duration-500 drop-shadow-sm">
                                @else
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center" style="background:#1D9E75;">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Corps de la carte --}}
                            <div class="flex flex-col flex-grow p-6 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-brand-green transition-colors">
                                    {{ $partner->name }}
                                </h3>

                                @if ($partner->description)
                                    <p class="text-gray-500 text-sm leading-relaxed mb-5 flex-grow">
                                        {{ $partner->description }}
                                    </p>
                                @else
                                    <div class="flex-grow"></div>
                                @endif

                                @if ($partner->website_url)
                                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-sm font-semibold border border-brand-green/30 text-brand-green bg-brand-green/5 hover:bg-brand-green hover:text-white hover:border-brand-green transition duration-200">
                                        Visiter le site
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <div class="mt-14 flex flex-col items-center gap-3">
                    {{ $partners->links() }}
                    <p class="text-xs text-gray-400">Page {{ $partners->currentPage() }} sur {{ $partners->lastPage() }}</p>
                </div>

            @else
                {{-- État vide --}}
                <div class="text-center bg-white py-20 px-8 rounded-2xl shadow-sm border border-gray-100 max-w-lg mx-auto mt-10">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">La liste de nos partenaires sera bientôt disponible.</p>
                </div>
            @endif

        </div>
    </section>

</x-layout>
