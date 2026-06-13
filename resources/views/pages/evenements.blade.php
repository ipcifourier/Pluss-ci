<x-layout title="Événements - PLUSS.CI">

    {{-- ========================================== --}}
    {{-- HERO — charte graphique orange/teal        --}}
    {{-- ========================================== --}}
    <section class="relative text-white overflow-hidden" style="background: linear-gradient(135deg, #0a5c41 0%, #1D9E75 55%, #25b585 100%);">
        {{-- Motif décoratif --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots-ev" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="2" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots-ev)"/>
            </svg>
        </div>
        <div class="absolute -top-16 -right-16 w-72 h-72 rounded-full opacity-10" style="background:#F97316;"></div>
        <div class="absolute -bottom-10 -left-10 w-48 h-48 rounded-full opacity-10" style="background:#25b585;"></div>

        <div class="relative z-10 container mx-auto px-4 py-16 text-center">
            {{-- Fil d'Ariane --}}
            <div class="flex items-center justify-center gap-2 text-xs font-medium text-white/60 mb-6 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
                <span>/</span>
                <span class="text-white/90">Événements</span>
            </div>

            {{-- Icône --}}
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/15 backdrop-blur mb-5 mx-auto">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>

            <span class="inline-block bg-brand-orange/20 text-brand-orange border border-brand-orange/30 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">
                Agenda
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                Nos <span class="text-brand-orange">Événements</span>
            </h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto leading-relaxed">
                Retrouvez toutes les conférences, ateliers et rencontres organisés dans le cadre de la plateforme PLUSS.CI.
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
    {{-- LISTE DES ÉVÉNEMENTS                       --}}
    {{-- ========================================== --}}
    <section class="pt-4 pb-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-5xl">

            @forelse ($events as $event)
                <article class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 mb-6 flex flex-col md:flex-row overflow-hidden group">

                    {{-- Colonne date --}}
                    <div class="md:w-36 shrink-0 flex flex-col items-center justify-center py-6 px-4 text-center" style="background: linear-gradient(160deg, #0a5c41, #1D9E75);">
                        <span class="text-4xl font-extrabold text-white leading-none">
                            {{ $event->event_date ? $event->event_date->format('d') : '--' }}
                        </span>
                        <span class="text-sm font-bold text-white/80 uppercase tracking-widest mt-1">
                            {{ $event->event_date ? $event->event_date->translatedFormat('M') : '' }}
                        </span>
                        <span class="text-xs text-white/60 mt-0.5">
                            {{ $event->event_date ? $event->event_date->format('Y') : '' }}
                        </span>
                        @if($event->event_date && $event->event_date->isToday())
                            <span class="mt-3 bg-brand-orange text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Aujourd'hui</span>
                        @elseif($event->event_date && $event->event_date->isTomorrow())
                            <span class="mt-3 bg-yellow-400 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Demain</span>
                        @endif
                    </div>

                    {{-- Contenu --}}
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div>
                            {{-- GTT badge --}}
                            @if($event->gtt)
                                <span class="inline-block text-[10px] font-bold px-2.5 py-1 rounded-full bg-brand-orange/10 text-brand-orange uppercase tracking-wider mb-3">
                                    {{ $event->gtt->name }}
                                </span>
                            @endif

                            <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-brand-green transition-colors leading-snug">
                                {{ $event->title }}
                            </h2>

                            @if($event->summary)
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
                                    {{ $event->summary }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-3 mt-5 pt-4 border-t border-gray-100">
                            {{-- Heure & lieu --}}
                            <div class="flex flex-wrap gap-4 text-xs text-gray-400">
                                @if($event->event_date)
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $event->event_date->format('H\hi') }}
                                    </span>
                                @endif
                                @if($event->event_location)
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $event->event_location }}
                                    </span>
                                @endif
                            </div>

                            {{-- Lien détail --}}
                            <a href="{{ route('evenements.show', $event->id) }}"
                               class="inline-flex items-center gap-1.5 text-sm font-bold text-brand-green hover:text-white hover:bg-brand-green px-4 py-2 rounded-lg border border-brand-green/30 transition duration-200">
                                Voir le détail
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                {{-- État vide --}}
                <div class="text-center bg-white py-20 px-8 rounded-2xl shadow-sm border border-gray-100 max-w-lg mx-auto mt-10">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Aucun événement à venir pour le moment.</p>
                    <p class="text-gray-400 text-sm mt-1">Revenez bientôt pour découvrir nos prochaines activités.</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($events->hasPages())
                <div class="mt-10 flex flex-col items-center gap-3">
                    {{ $events->links() }}
                    <p class="text-xs text-gray-400">Page {{ $events->currentPage() }} sur {{ $events->lastPage() }}</p>
                </div>
            @endif

        </div>
    </section>

</x-layout>
