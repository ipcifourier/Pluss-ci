<x-layout
    :title="'Mot de la Coordinatrice — ' . ($page->title ?? 'PLUSS-CI')"
    description="Découvrez le message institutionnel de la Coordinatrice Générale de la Plateforme Nationale Une Seule Santé (PLUSS-CI), Dr Djeneba OUATTARA."
>

{{-- ═══════════════════════════════════════════════════════════
     HERO BANNER — Dégradé teal institutionnel
═══════════════════════════════════════════════════════════ --}}
<div class="relative bg-gradient-to-br from-[#0a5c41] via-[#1D9E75] to-[#25b585] overflow-hidden">

    {{-- Motif décoratif (cercles SVG en arrière-plan) --}}
    <svg class="absolute inset-0 w-full h-full opacity-[0.07] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="hero-dots" x="0" y="0" width="48" height="48" patternUnits="userSpaceOnUse">
                <circle cx="24" cy="24" r="2" fill="white"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#hero-dots)"/>
    </svg>

    {{-- Cercles décoratifs flottants --}}
    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="absolute -left-10 -bottom-10 w-56 h-56 rounded-full bg-white/5 pointer-events-none"></div>

    <div class="container mx-auto px-4 py-16 md:py-24 relative z-10">
        {{-- Fil d'Ariane --}}
        <div class="flex items-center gap-2 mb-6 text-white/60 text-sm">
            <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
            <span>›</span>
            <span class="text-white font-medium">Présentation</span>
            <span>›</span>
            <span class="text-white font-medium">Mot de la Coordinatrice</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-end gap-8">
            <div class="flex-1">
                {{-- Badge section --}}
                <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full border border-white/20 mb-5">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    Message Institutionnel
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight">
                    Mot de la<br>
                    <span class="text-white/80">Coordinatrice</span>
                </h1>
                <div class="flex items-center gap-3 mt-5">
                    <div class="w-12 h-1 bg-white/50 rounded-full"></div>
                    <div class="w-4 h-1 bg-white/30 rounded-full"></div>
                </div>
            </div>

            {{-- Portrait ou initiales --}}
            <div class="flex-shrink-0">
                <div class="relative">
                    @if(isset($page->image) && $page->image)
                        <img src="{{ Storage::url($page->image) }}"
                             alt="Dr Djeneba OUATTARA"
                             class="w-28 h-28 md:w-36 md:h-36 rounded-full object-cover object-top border-4 border-white/40 shadow-2xl">
                    @else
                        <div class="w-28 h-28 md:w-36 md:h-36 rounded-full bg-white/20 border-4 border-white/30 flex items-center justify-center shadow-2xl backdrop-blur-sm">
                            <span class="text-white font-extrabold text-4xl tracking-tight">DO</span>
                        </div>
                    @endif
                    {{-- Pastille "Coordinatrice" --}}
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-white text-[#0a5c41] text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md whitespace-nowrap">
                        Coordinatrice
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     CORPS DE PAGE — Fond gris clair
═══════════════════════════════════════════════════════════ --}}
<div class="bg-gray-50 py-12 md:py-20">
    <div class="container mx-auto px-4 max-w-4xl">

        {{-- Carte principale --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            {{-- Barre d'accent teal --}}
            <div class="h-1.5 bg-gradient-to-r from-[#1D9E75] via-[#25b585] to-[#1D9E75]"></div>

            <div class="p-8 md:p-14">

                {{-- ─────────────────────────────────────────
                     SECTION 1 — Accroche avec lettrine
                ───────────────────────────────────────── --}}
                <div class="mb-10">
                    <p class="text-gray-800 text-lg leading-relaxed text-justify">
                        <span
                            class="float-left font-extrabold text-[#1D9E75] leading-[0.75] mr-3 mt-1 select-none"
                            style="font-size: 5.5rem; font-family: Georgia, serif;">L</span>
                        a Plateforme Nationale <strong class="text-[#0a5c41]">Une Seule Santé - Côte d'Ivoire</strong>
                        est née de la volonté du Gouvernement ivoirien de renforcer la prévention, la détection et
                        la réponse aux menaces sanitaires, à travers une approche coordonnée, multisectorielle et durable.
                    </p>
                    <div class="clear-both"></div>
                    <p class="text-gray-700 leading-relaxed mt-5 text-justify">
                        Dans un monde marqué par l'émergence de nouvelles épidémies, la recrudescence des zoonoses,
                        les effets du changement climatique, les risques liés à la sécurité sanitaire des aliments
                        et la résistance aux antimicrobiens, il est désormais indispensable de dépasser les approches
                        sectorielles classiques. La santé humaine, la santé animale, la santé végétale et la santé
                        environnementale sont profondément liées. Les protéger exige une action collective, structurée
                        et anticipatrice.
                    </p>
                </div>

                {{-- ─────────────────────────────────────────
                     CITATION 1 — Le lien entre les quatre santés
                ───────────────────────────────────────── --}}
                <blockquote class="relative rounded-xl overflow-hidden my-10"
                            style="background-color: rgba(29,158,117,0.07); border-left: 4px solid #1D9E75;">
                    <div class="px-8 py-7">
                        <svg class="absolute right-5 top-5 w-16 h-16 opacity-10 pointer-events-none"
                             fill="#1D9E75" viewBox="0 0 32 32">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064
                                     3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472
                                     -.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4z
                                     m16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064
                                     6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472
                                     -5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104
                                     6.528-9.024L25.864 4z"/>
                        </svg>
                        <p class="text-lg md:text-xl font-semibold italic leading-relaxed relative z-10"
                           style="color: #0a5c41;">
                            « La santé humaine, la santé animale, la santé végétale et la santé
                            environnementale sont profondément liées. Les protéger exige une action
                            collective, structurée et anticipatrice. »
                        </p>
                    </div>
                </blockquote>

                {{-- ─────────────────────────────────────────
                     SECTION 2 — Développement institutionnel
                ───────────────────────────────────────── --}}
                <div class="space-y-5 mb-10">
                    <p class="text-gray-700 leading-relaxed text-justify">
                        C'est dans cette dynamique que la Côte d'Ivoire a officiellement adopté l'approche
                        « Une Seule Santé » avec la création de la Plateforme Nationale par décret du
                        <strong class="text-gray-800">3 avril 2019</strong>. Cette étape majeure a permis de traduire
                        l'engagement politique du pays en un cadre institutionnel de coordination réunissant les
                        ministères et secteurs clés, notamment la Primature, la Santé, les Ressources animales
                        et halieutiques, l'Agriculture, l'Environnement, ainsi que les partenaires techniques
                        et financiers.
                    </p>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        La révision du décret, intervenue le <strong class="text-gray-800">23 décembre 2020</strong>,
                        a marqué une nouvelle avancée en intégrant la santé végétale et les plateformes
                        départementales, renforçant ainsi l'ancrage territorial et l'approche intégrée de la
                        sécurité sanitaire.
                    </p>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Placée sous l'autorité de la Primature, la Plateforme Nationale Une Seule Santé constitue
                        aujourd'hui un outil stratégique de gouvernance, de coordination et de mobilisation. Elle
                        vise à susciter l'adhésion de l'ensemble des secteurs, des institutions, des collectivités,
                        du monde académique, de la société civile, des partenaires et des communautés.
                    </p>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        Avec l'appui constant de partenaires tels que la <strong class="text-gray-800">FAO</strong>,
                        à travers son Centre d'urgence pour les maladies animales transfrontalières, et
                        l'<strong class="text-gray-800">USAID</strong>, la Côte d'Ivoire poursuit ses efforts pour
                        consolider une réponse intégrée, fondée sur la collaboration, le partage d'informations,
                        la surveillance coordonnée, la préparation et la riposte rapide.
                    </p>
                </div>

                {{-- ─────────────────────────────────────────
                     QUATRE PILIERS OPÉRATIONNELS
                ───────────────────────────────────────── --}}
                <div class="my-12">
                    <div class="flex items-center gap-3 mb-7">
                        <span class="block w-8 h-0.5 rounded-full" style="background:#1D9E75"></span>
                        <h3 class="font-bold text-gray-800 text-base uppercase tracking-widest text-sm">
                            Nos quatre piliers opérationnels
                        </h3>
                        <span class="block flex-1 h-0.5 rounded-full bg-gray-100"></span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                        {{-- Pilier 1 : Surveillance --}}
                        <div class="rounded-xl p-5 text-center border transition hover:shadow-md"
                             style="background:rgba(29,158,117,0.06); border-color:rgba(29,158,117,0.2);">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3"
                                 style="background:rgba(29,158,117,0.15);">
                                <svg class="w-6 h-6" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                             9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                                             0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-sm mb-1" style="color:#0a5c41">Surveillance</h4>
                            <p class="text-gray-500 text-xs leading-snug">
                                Systèmes d'alerte intégrés et partagés
                            </p>
                        </div>

                        {{-- Pilier 2 : Prévention --}}
                        <div class="rounded-xl p-5 text-center border transition hover:shadow-md"
                             style="background:rgba(29,158,117,0.06); border-color:rgba(29,158,117,0.2);">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3"
                                 style="background:rgba(29,158,117,0.15);">
                                <svg class="w-6 h-6" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944
                                             a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003
                                             9c0 5.591 3.824 10.29 9 11.622 5.176-1.332
                                             9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-sm mb-1" style="color:#0a5c41">Prévention</h4>
                            <p class="text-gray-500 text-xs leading-snug">
                                Programmes multisectoriels de vaccination et biosécurité
                            </p>
                        </div>

                        {{-- Pilier 3 : Coordination --}}
                        <div class="rounded-xl p-5 text-center border transition hover:shadow-md"
                             style="background:rgba(29,158,117,0.06); border-color:rgba(29,158,117,0.2);">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3"
                                 style="background:rgba(29,158,117,0.15);">
                                <svg class="w-6 h-6" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10
                                             0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3
                                             0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857
                                             m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0
                                             3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-sm mb-1" style="color:#0a5c41">Coordination</h4>
                            <p class="text-gray-500 text-xs leading-snug">
                                Groupes de travail thématiques multisectoriels
                            </p>
                        </div>

                        {{-- Pilier 4 : Recherche --}}
                        <div class="rounded-xl p-5 text-center border transition hover:shadow-md"
                             style="background:rgba(29,158,117,0.06); border-color:rgba(29,158,117,0.2);">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3"
                                 style="background:rgba(29,158,117,0.15);">
                                <svg class="w-6 h-6" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168
                                             5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332
                                             .477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5
                                             c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477
                                             18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-sm mb-1" style="color:#0a5c41">Recherche</h4>
                            <p class="text-gray-500 text-xs leading-snug">
                                Publications et études conjointes inter-sectorielles
                            </p>
                        </div>

                    </div>
                </div>

                {{-- ─────────────────────────────────────────
                     CITATION 2 — Conviction centrale (fond sombre)
                ───────────────────────────────────────── --}}
                <blockquote class="relative bg-gray-900 rounded-2xl overflow-hidden my-10">
                    {{-- Barre latérale teal --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                         style="background:#1D9E75"></div>
                    {{-- Guillemets décoratifs --}}
                    <svg class="absolute right-6 top-6 w-20 h-20 pointer-events-none opacity-[0.06]"
                         fill="white" viewBox="0 0 32 32">
                        <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064
                                 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472
                                 -.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4z
                                 m16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064
                                 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472
                                 -5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104
                                 6.528-9.024L25.864 4z"/>
                    </svg>
                    <div class="px-10 py-8">
                        <p class="text-white font-semibold text-xl italic leading-relaxed">
                            « Aucune menace sanitaire majeure ne peut être efficacement maîtrisée
                            par un seul secteur. »
                        </p>
                    </div>
                </blockquote>

                {{-- ─────────────────────────────────────────
                     SECTION 3 — Ambition conclusive
                ───────────────────────────────────────── --}}
                <div class="space-y-5 mb-12">
                    <p class="text-gray-700 leading-relaxed text-justify">
                        La célébration, chaque <strong class="text-gray-800">3 novembre</strong>, de la
                        Journée Une Seule Santé en Côte d'Ivoire est l'occasion de rappeler que cette
                        approche n'est pas seulement un concept technique. Elle est une exigence de
                        gouvernance, une responsabilité partagée et un levier essentiel pour protéger
                        durablement les populations, les animaux, les végétaux et l'environnement.
                    </p>
                    <p class="text-gray-700 leading-relaxed text-justify font-medium" style="color:#0a5c41;">
                        Notre ambition est claire : faire de l'approche Une Seule Santé un pilier de la
                        sécurité sanitaire nationale, de la résilience des territoires et du développement
                        durable de la Côte d'Ivoire.
                    </p>
                </div>

                {{-- ─────────────────────────────────────────
                     SIGNATURE
                ───────────────────────────────────────── --}}
                <div class="border-t border-gray-100 pt-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">

                        {{-- Initiales en cercle --}}
                        @if(isset($page->image) && $page->image)
                            <img src="{{ Storage::url($page->image) }}"
                                 alt="Dr Djeneba OUATTARA"
                                 class="w-16 h-16 rounded-full object-cover object-top border-2 flex-shrink-0 shadow-md"
                                 style="border-color:#1D9E75">
                        @else
                            <div class="w-16 h-16 rounded-full flex items-center justify-center
                                        text-white font-bold text-xl shadow-lg flex-shrink-0"
                                 style="background:#1D9E75">
                                DO
                            </div>
                        @endif

                        {{-- Identité --}}
                        <div class="flex-1">
                            <p class="font-extrabold text-gray-900 text-lg leading-tight">
                                Dr Djénéba OUATTARA
                            </p>
                            <p class="font-semibold text-sm" style="color:#1D9E75">
                                Coordinatrice de la Plateforme Nationale Une Seule Santé
                            </p>
                            <p class="text-gray-500 text-xs mt-0.5 leading-snug">
                                Conseiller du Premier Ministre en charge de la Santé,<br>
                                de la Protection sociale et de la Nutrition
                            </p>
                        </div>

                        {{-- Badge "Une Seule Santé" --}}
                        <div class="hidden md:flex items-center gap-2 rounded-full px-5 py-2.5 border"
                             style="background:rgba(29,158,117,0.08); border-color:rgba(29,158,117,0.3);">
                            <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:#1D9E75"></span>
                            <span class="font-semibold text-sm" style="color:#0a5c41">Une Seule Santé</span>
                        </div>

                    </div>
                </div>

            </div>{{-- /p-8 --}}
        </div>{{-- /card --}}

    </div>{{-- /container --}}
</div>{{-- /bg-gray-50 --}}

</x-layout>
