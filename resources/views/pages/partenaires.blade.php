<x-layout title="Nos Partenaires - PLUSS.CI">

    {{-- ========================================== --}}
    {{-- EN-TÊTE DE LA PAGE (HERO)                  --}}
    {{-- ========================================== --}}
    <div class="relative bg-blue-900 h-72 flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800 opacity-90"></div>
        <div class="relative z-10 text-center px-4 mt-10">
            <span class="text-brand-orange font-bold tracking-widest uppercase text-sm mb-2 block animate-fade-in-up">Collaboration & Synergie</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-xl tracking-tight">
                Nos <span class="text-brand-orange">Partenaires</span>
            </h1>
            <p class="text-lg text-gray-200 mt-4 max-w-2xl mx-auto font-light">
                La mise en œuvre de l'approche "Une Seule Santé" est rendue possible grâce à l'engagement de nos partenaires nationaux et internationaux.
            </p>
            <div class="w-24 h-1 bg-brand-orange mx-auto mt-6 rounded-full shadow-sm"></div>
        </div>
    </div>
{{-- ========================================== --}}
    {{-- SECTION : GRILLE DES PARTENAIRES           --}}
    {{-- ========================================== --}}
    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-7xl">
            
            @if(isset($partners) && $partners->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($partners as $partner)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col h-full group p-8">
                            
                            {{-- Espace pour le Logo --}}
                            <div class="h-32 flex items-center justify-center mb-6">
                                @if($partner->logo_path)
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="Logo {{ $partner->name }}" class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 transition duration-500">
                                @else
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-300">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Détails du partenaire --}}
                            <div class="text-center flex-grow flex flex-col">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $partner->name }}</h3>
                                
                                @if($partner->description)
                                    <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                        {{ $partner->description }}
                                    </p>
                                @endif

                                @if($partner->website_url)
                                    <div class="mt-auto">
                                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 text-brand-orange font-semibold hover:text-orange-700 hover:bg-orange-50 px-4 py-2 rounded-lg transition duration-300 border border-orange-100 text-sm">
                                            Visiter le site
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- PAGINATION AJOUTÉE ICI --}}
                <div class="mt-12">
                    {{ $partners->links() }}
                </div>

            @else
                <div class="text-center bg-white p-12 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-lg">La liste de nos partenaires sera bientôt disponible.</p>
                </div>
            @endif

        </div>
    </section>

</x-layout>