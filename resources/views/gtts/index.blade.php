<x-layout>
    {{-- Header --}}
    <section class="relative text-white overflow-hidden" style="background: linear-gradient(135deg, #0a5c41 0%, #1D9E75 60%, #25b585 100%);">
        {{-- Motif de points --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots-gtt" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="2" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots-gtt)"/>
            </svg>
        </div>
        <div class="absolute -top-16 -right-16 w-72 h-72 rounded-full opacity-10" style="background:#F97316;"></div>
        <div class="absolute -bottom-10 -left-10 w-48 h-48 rounded-full opacity-10" style="background:#25b585;"></div>

        <div class="relative z-10 container mx-auto px-4 py-16 text-center">
            {{-- Fil d'Ariane --}}
            <div class="flex items-center justify-center gap-2 text-xs font-medium text-white/60 mb-6 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
                <span>/</span>
                <span class="text-white/90">Groupes de Travail Technique</span>
            </div>

            {{-- Icône --}}
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/15 backdrop-blur mb-5 mx-auto">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>

            <span class="inline-block bg-brand-orange/20 text-brand-orange border border-brand-orange/30 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">
                Une Seule Santé
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                Groupes de <span class="text-brand-orange">Travail Technique</span>
            </h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto leading-relaxed">
                Découvrez les équipes thématiques qui œuvrent ensemble pour la mise en œuvre de l'approche <em>"Une Seule Santé"</em>.
            </p>
            <div class="w-20 h-1 bg-brand-orange mx-auto mt-8 rounded-full"></div>
        </div>

        {{-- Vague de transition --}}
        <div class="relative h-12 -mb-1">
            <svg viewBox="0 0 1440 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 w-full" preserveAspectRatio="none">
                <path d="M0 48L1440 48L1440 0C1200 40 960 48 720 40C480 32 240 0 0 0L0 48Z" fill="white"/>
            </svg>
        </div>
    </section>

    {{-- Content --}}
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($gtts as $gtt)
                <div
                    class="bg-white rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 overflow-hidden flex flex-col h-full">

                    {{-- Image --}}
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        @if ($gtt->cover_image)
                            <img src="{{ asset('images/' . $gtt->cover_image) }}" alt="{{ $gtt->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Text --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $gtt->name }}</h2>
                        <p class="text-gray-600 mb-4 flex-grow line-clamp-3">
                            {{ Str::limit(strip_tags($gtt->description), 120) }}
                        </p>
                        <a href="{{ route('gtts.show', $gtt) }}"
                            class="text-brand-orange font-bold hover:underline mt-auto flex items-center gap-1">
                            Découvrir le groupe <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun groupe de travail n'est disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
