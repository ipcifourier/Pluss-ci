<x-layout
    :title="'Généralités sur les GTT | PLUSS-CI'"
    description="Présentation, définition, justification, missions et principes directeurs des Groupes Techniques de Travail (GTT) de la Plateforme Nationale Une Seule Santé de Côte d'Ivoire."
>

{{-- HERO BANNER --}}
<div class="relative bg-gradient-to-br from-[#0a5c41] via-[#1D9E75] to-[#25b585] overflow-hidden">
    <svg class="absolute inset-0 w-full h-full opacity-[0.06] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="gtt-grid" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.8"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#gtt-grid)"/>
    </svg>
    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="absolute -left-16 -bottom-16 w-72 h-72 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="container mx-auto px-4 py-16 md:py-24 relative z-10">
        <div class="flex items-center gap-2 mb-6 text-white/60 text-sm">
            <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
            <span>›</span><span class="text-white font-medium">GTT</span>
            <span>›</span><span class="text-white font-medium">Généralités</span>
        </div>
        <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full border border-white/20 mb-5">
            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
            Groupes Techniques de Travail
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight max-w-3xl">
            Présentation &amp; Missions
        </h1>
        <p class="text-white/70 mt-4 text-lg font-light max-w-2xl leading-relaxed">
            Cadres techniques multisectoriels et multidisciplinaires au service de l'approche <em>Une Seule Santé</em>.
        </p>
        <div class="flex items-center gap-3 mt-6">
            <div class="w-12 h-1 bg-white/50 rounded-full"></div>
            <div class="w-4 h-1 bg-white/30 rounded-full"></div>
        </div>
    </div>
</div>

{{-- SOMMAIRE RAPIDE --}}
<div class="bg-white border-b border-gray-100 sticky top-0 z-30 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-none text-sm font-medium whitespace-nowrap">
            <a href="#definition"   class="px-3 py-1.5 rounded-full hover:bg-[#1D9E75]/10 transition" style="color:#1D9E75">1. Définition</a>
            <span class="text-gray-300">|</span>
            <a href="#justification" class="px-3 py-1.5 rounded-full hover:bg-[#1D9E75]/10 transition" style="color:#1D9E75">2. Justification</a>
            <span class="text-gray-300">|</span>
            <a href="#mission-generale" class="px-3 py-1.5 rounded-full hover:bg-[#1D9E75]/10 transition" style="color:#1D9E75">3. Mission générale</a>
            <span class="text-gray-300">|</span>
            <a href="#missions-specifiques" class="px-3 py-1.5 rounded-full hover:bg-[#1D9E75]/10 transition" style="color:#1D9E75">4. Missions spécifiques</a>
            <span class="text-gray-300">|</span>
            <a href="#principes" class="px-3 py-1.5 rounded-full hover:bg-[#1D9E75]/10 transition" style="color:#1D9E75">5. Principes directeurs</a>
        </div>
    </div>
</div>

{{-- CORPS --}}
<div class="bg-gray-50 py-12 md:py-20">
    <div class="container mx-auto px-4 max-w-4xl space-y-10">

        {{-- 1. DÉFINITION --}}
        <div id="definition" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden scroll-mt-16">
            <div class="h-1.5 bg-gradient-to-r from-[#1D9E75] via-[#25b585] to-[#1D9E75]"></div>
            <div class="p-8 md:p-10">
                <div class="flex items-center gap-3 mb-7">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl text-white font-extrabold text-sm shadow-md flex-shrink-0" style="background:#1D9E75">1</div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Définition</h2>
                </div>
                <div class="space-y-4 text-gray-700 leading-relaxed text-justify">
                    <p>
                        Les <strong class="text-gray-900">Groupes Techniques de Travail (GTT)</strong> de la Plateforme Nationale Une Seule Santé - Côte d'Ivoire sont des <strong class="text-gray-900">cadres techniques multisectoriels, multidisciplinaires et spécialisés</strong>, mis en place pour appuyer l'opérationnalisation de l'approche « Une Seule Santé ».
                    </p>
                    <p>
                        Ils réunissent des experts issus des secteurs de la <strong class="text-gray-900">santé humaine</strong>, de la <strong class="text-gray-900">santé animale</strong>, de la <strong class="text-gray-900">santé végétale</strong>, de l'<strong class="text-gray-900">environnement</strong>, de l'<strong class="text-gray-900">agriculture</strong>, de la <strong class="text-gray-900">recherche</strong>, de la <strong class="text-gray-900">sécurité sanitaire des aliments</strong>, de la gestion des urgences et des partenaires techniques.
                    </p>
                    <p>
                        Leur rôle est de contribuer à la <strong class="text-gray-900">prévention, la détection, l'analyse, la préparation et la riposte coordonnée</strong>, face aux menaces sanitaires, conformément aux exigences du <strong class="text-gray-900">Règlement Sanitaire International (RSI)</strong>.
                    </p>
                </div>

                {{-- Secteurs représentés --}}
                <div class="mt-8 grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach([
                        ['Santé humaine',   'M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785c-.074.205-.01.12.019.12m14.095-5.13c.074-.205.01-.12-.019-.12M5.106 17.785L4 17.5m14.95-2.785l1.106.285M5.5 12H4m16 0h-1.5'],
                        ['Santé animale',   'M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.729c.386.283.771.364 1.154.304m-1.154-.304c-.552-.304-.955-.77-1.154-1.229m1.154 1.229L5.25 21m-1.5-3.271A6.735 6.735 0 014.5 18c0-.608.084-1.197.24-1.757'],
                        ['Environnement',   'M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z'],
                        ['Sécurité aliments','M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z'],
                    ] as [$label, $icon])
                    <div class="flex flex-col items-center gap-2 rounded-xl p-4 text-center border" style="background:rgba(29,158,117,0.05);border-color:rgba(29,158,117,0.2);">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background:rgba(29,158,117,0.12);">
                            <svg class="w-5 h-5" fill="none" stroke="#1D9E75" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 leading-tight">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 2. JUSTIFICATION --}}
        <div id="justification" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden scroll-mt-16">
            <div class="h-1.5 bg-gradient-to-r from-[#1D9E75] via-[#25b585] to-[#1D9E75]"></div>
            <div class="p-8 md:p-10">
                <div class="flex items-center gap-3 mb-7">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl text-white font-extrabold text-sm shadow-md flex-shrink-0" style="background:#1D9E75">2</div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Justification</h2>
                </div>

                {{-- Citation d'accroche --}}
                <blockquote class="relative rounded-xl px-7 py-5 mb-7 border-l-4 overflow-hidden" style="background:rgba(29,158,117,0.06);border-color:#1D9E75;">
                    <p class="text-gray-700 leading-relaxed italic">
                        Les menaces sanitaires actuelles — zoonoses, épidémies, pandémies, résistance aux antimicrobiens, risques alimentaires, événements chimiques, radiologiques ou biologiques — <strong class="text-gray-900 not-italic">dépassent les frontières institutionnelles et sectorielles.</strong>
                    </p>
                </blockquote>

                <p class="text-gray-700 leading-relaxed mb-6">
                    La mise en place des GTT permet de disposer de cadres techniques capables de :
                </p>
                <ul class="space-y-3">
                    @foreach([
                        'Renforcer la coordination intersectorielle',
                        'Analyser les risques sanitaires de manière intégrée',
                        'Favoriser le partage régulier des données',
                        'Soutenir la planification et la mise en œuvre des interventions',
                        'Contribuer au renforcement des capacités nationales du RSI',
                        'Assurer une articulation entre les niveaux national, sectoriel et territorial',
                    ] as $item)
                    <li class="flex items-start gap-3">
                        <span class="mt-1.5 w-2 h-2 rounded-full flex-shrink-0" style="background:#1D9E75"></span>
                        <span class="text-gray-700 leading-relaxed">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- 3. MISSION GÉNÉRALE --}}
        <div id="mission-generale" class="rounded-2xl overflow-hidden scroll-mt-16" style="background:linear-gradient(135deg,#0a5c41 0%,#1D9E75 100%);">
            <div class="p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/20 text-white font-extrabold text-sm flex-shrink-0">3</div>
                    <h2 class="text-2xl font-extrabold text-white tracking-tight">Mission générale des GTT</h2>
                </div>
                <p class="text-white/90 leading-relaxed text-lg text-justify">
                    La mission générale des GTT est de <strong class="text-white">fournir une expertise technique</strong> à la Plateforme Une Seule Santé – Côte d'Ivoire pour la <strong class="text-white">planification, la coordination, le suivi et l'évaluation</strong> des interventions relatives aux différents domaines du RSI.
                </p>
                <p class="text-white/80 leading-relaxed mt-4 text-justify">
                    Ils contribuent à traduire les <strong class="text-white">orientations stratégiques</strong> de la Plateforme en actions techniques concrètes, coordonnées et mesurables.
                </p>
            </div>
        </div>

        {{-- 4. MISSIONS SPÉCIFIQUES --}}
        <div id="missions-specifiques" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden scroll-mt-16">
            <div class="h-1.5 bg-gradient-to-r from-[#1D9E75] via-[#25b585] to-[#1D9E75]"></div>
            <div class="p-8 md:p-10">
                <div class="flex items-center gap-3 mb-7">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl text-white font-extrabold text-sm shadow-md flex-shrink-0" style="background:#1D9E75">4</div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Missions spécifiques</h2>
                </div>
                <p class="text-gray-600 mb-6">Les GTT ont notamment pour missions de :</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach([
                        'Analyser les données et informations relatives à leur domaine d\'intervention',
                        'Identifier les risques, les gaps et les besoins prioritaires',
                        'Proposer des plans d\'action techniques',
                        'Contribuer à l\'élaboration ou à la révision des outils, protocoles, directives et procédures',
                        'Appuyer la préparation et la réponse aux urgences sanitaires',
                        'Favoriser le partage d\'informations entre les secteurs',
                        'Contribuer à la mobilisation des expertises et des ressources',
                        'Suivre la mise en œuvre des recommandations',
                        'Produire des rapports techniques périodiques à l\'attention du Secrétariat multisectoriel',
                        'Contribuer à l\'évaluation des capacités nationales selon les domaines du RSI',
                    ] as $i => $mission)
                    <div class="flex items-start gap-3 rounded-xl p-4 border transition hover:shadow-sm" style="background:rgba(29,158,117,0.04);border-color:rgba(29,158,117,0.15);">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center text-white font-bold text-xs" style="background:#1D9E75">{{ $i + 1 }}</span>
                        <span class="text-gray-700 text-sm leading-relaxed">{{ $mission }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 5. PRINCIPES DIRECTEURS --}}
        <div id="principes" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden scroll-mt-16">
            <div class="h-1.5 bg-gradient-to-r from-[#1D9E75] via-[#25b585] to-[#1D9E75]"></div>
            <div class="p-8 md:p-10">
                <div class="flex items-center gap-3 mb-7">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl text-white font-extrabold text-sm shadow-md flex-shrink-0" style="background:#1D9E75">5</div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Principes directeurs</h2>
                </div>
                <p class="text-gray-600 mb-7">Le fonctionnement des GTT repose sur les principes suivants :</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach([
                        ['Multisectorialité',        'Implication des secteurs humain, animal, végétal et environnemental',          'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z'],
                        ['Multidisciplinarité',      'Mobilisation d\'expertises diverses',                                          'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'],
                        ['Complémentarité',          'Éviter les doublons avec les dispositifs sectoriels existants',               'M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244'],
                        ['Redevabilité',             'Production régulière de rapports et recommandations',                         'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z'],
                        ['Efficacité opérationnelle','Focalisation sur des résultats mesurables',                                   'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
                        ['Alignement RSI',           'Contribution directe au renforcement des capacités nationales',              'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z'],
                        ['Coordination PLUSS-CI',    'Harmonisation des travaux sous l\'autorité du Secrétariat multisectoriel',   'M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75'],
                    ] as [$titre, $desc, $icon])
                    <div class="rounded-xl p-5 border transition hover:shadow-md hover:-translate-y-0.5 duration-200" style="background:rgba(29,158,117,0.04);border-color:rgba(29,158,117,0.2);">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(29,158,117,0.15);">
                                <svg class="w-5 h-5" fill="none" stroke="#1D9E75" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                                </svg>
                            </div>
                            <h4 class="font-bold text-sm" style="color:#0a5c41">{{ $titre }}</h4>
                        </div>
                        <p class="text-gray-600 text-xs leading-relaxed">{{ $desc }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>{{-- /container --}}
</div>{{-- /bg-gray-50 --}}

</x-layout>