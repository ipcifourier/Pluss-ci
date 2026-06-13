<x-layout
    :title="'Biographie — Dr Djénéba N\'gnôh OUATTARA | PLUSS-CI'"
    description="Biographie officielle de Dr Djénéba N'gnôh OUATTARA, Pharmacienne, PhD en Santé Publique, Conseillère du Premier Ministre et Coordinatrice de la Plateforme Nationale Une Seule Santé."
>

{{-- HERO BANNER --}}
<div class="relative bg-gradient-to-br from-[#0a5c41] via-[#1D9E75] to-[#25b585] overflow-hidden">
    <svg class="absolute inset-0 w-full h-full opacity-[0.07] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
        <defs><pattern id="bio-dots" x="0" y="0" width="48" height="48" patternUnits="userSpaceOnUse"><circle cx="24" cy="24" r="2" fill="white"/></pattern></defs>
        <rect width="100%" height="100%" fill="url(#bio-dots)"/>
    </svg>
    <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="absolute -left-12 -bottom-12 w-64 h-64 rounded-full bg-white/5 pointer-events-none"></div>
    <div class="container mx-auto px-4 py-16 md:py-24 relative z-10">
        <div class="flex items-center gap-2 mb-6 text-white/60 text-sm">
            <a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a>
            <span>›</span><span class="text-white font-medium">Présentation</span>
            <span>›</span><span class="text-white font-medium">Biographie</span>
        </div>
        <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full border border-white/20 mb-5">
            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
            Biographie Officielle
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight">
            Dr Djénéba<br><span class="text-white/80">N'gnôh OUATTARA</span>
        </h1>
        <p class="text-white/70 mt-4 text-lg font-light tracking-wide">
            Pharmacienne &nbsp;·&nbsp; PhD Santé Publique &nbsp;·&nbsp; Chevalier de l'Ordre National
        </p>
        <div class="flex items-center gap-3 mt-5">
            <div class="w-12 h-1 bg-white/50 rounded-full"></div>
            <div class="w-4 h-1 bg-white/30 rounded-full"></div>
        </div>
    </div>
</div>

{{-- CORPS --}}
<div class="bg-gray-50 py-12 md:py-20">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- COLONNE GAUCHE sticky --}}
            <aside class="w-full lg:w-80 shrink-0">
                <div class="sticky top-8 space-y-5">

                    {{-- Carte photo --}}
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                        <div class="relative h-80 bg-gray-100">
                            <img src="{{ asset('images/cordo.png') }}" alt="Dr Djénéba N'gnôh OUATTARA"
                                 class="w-full h-full object-cover object-top">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a5c41]/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <span class="inline-flex items-center gap-1.5 bg-white/90 text-[#0a5c41] text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Chevalier de l'Ordre National
                                </span>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h2 class="text-xl font-extrabold text-gray-900 leading-tight">Dr Djénéba N'gnôh<br>OUATTARA</h2>
                            <p class="text-sm font-semibold mt-1" style="color:#1D9E75">Conseillère du Premier Ministre</p>
                            <p class="text-xs text-gray-400 mt-0.5">Santé, Hygiène Publique &amp; Nutrition</p>
                            <div class="border-t border-gray-100 mt-5 pt-5 space-y-3 text-left">
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span class="text-gray-600 text-xs leading-snug">Primature de la République de Côte d'Ivoire</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="text-gray-600 text-xs">Abidjan, Côte d'Ivoire</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    <span class="text-gray-600 text-xs leading-snug">PhD Santé Publique — Université FHB de Cocody</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-gray-600 text-xs">Plus de 25 ans d'expérience</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Fonctions actuelles --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-xs font-bold uppercase tracking-widest mb-4" style="color:#1D9E75">Fonctions actuelles</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-2.5"><span class="mt-1.5 w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#1D9E75"></span><span class="text-gray-600 text-xs leading-snug">Conseillère du Premier Ministre — Santé, Hygiène Publique &amp; Nutrition</span></li>
                            <li class="flex items-start gap-2.5"><span class="mt-1.5 w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#1D9E75"></span><span class="text-gray-600 text-xs leading-snug">Coordinatrice — Plateforme Nationale Une Seule Santé (PLUSS-CI)</span></li>
                            <li class="flex items-start gap-2.5"><span class="mt-1.5 w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#1D9E75"></span><span class="text-gray-600 text-xs leading-snug">Point focal — Plateforme Nationale de Coordination du Financement de la Santé (PNCFS)</span></li>
                            <li class="flex items-start gap-2.5"><span class="mt-1.5 w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#1D9E75"></span><span class="text-gray-600 text-xs leading-snug">Chargée de recherche — UFR Sciences Pharmaceutiques et Biologiques</span></li>
                        </ul>
                    </div>

                </div>
            </aside>

            {{-- COLONNE DROITE --}}
            <div class="flex-1 space-y-8">

                {{-- Biographie --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="h-1.5 bg-gradient-to-r from-[#1D9E75] via-[#25b585] to-[#1D9E75]"></div>
                    <div class="p-8 md:p-12">
                        <div class="mb-8">
                            <p class="text-gray-800 text-lg leading-relaxed text-justify">
                                <span class="float-left font-extrabold text-[#1D9E75] leading-[0.75] mr-3 mt-1 select-none" style="font-size:5.5rem;font-family:Georgia,serif;">D</span>
                                r Djénéba N'gnôh Ouattara est Pharmacienne et Docteure en Santé Publique de l'Université
                                Félix Houphouët-Boigny de Cocody. Forte de plus de vingt-cinq années d'exercice au carrefour
                                de la santé publique, de la gouvernance institutionnelle et de la décision politique, elle
                                compte parmi les personnalités les plus influentes du secteur sanitaire ivoirien.
                            </p>
                            <div class="clear-both"></div>
                        </div>
                        <div class="space-y-5 text-gray-700 leading-relaxed text-justify">
                            <p>
                                Depuis <strong class="text-gray-800">2022</strong>, elle exerce les fonctions de
                                <strong class="text-gray-800">Conseillère du Premier Ministre</strong> en charge de la Santé,
                                de l'Hygiène Publique et de la Nutrition à la Primature de la République de Côte d'Ivoire.
                                À ce titre, elle assure le conseil stratégique au chef du Gouvernement sur les priorités
                                sanitaires nationales, anime les concertations interministérielles et pilote les dossiers à
                                fort enjeu institutionnel, notamment la Couverture Maladie Universelle (CMU), les ressources
                                humaines en santé et la régulation pharmaceutique. Elle y exerce simultanément les fonctions
                                de Point focal gouvernemental de la <strong class="text-gray-800">PNCFS</strong> et de
                                Coordinatrice du Secrétariat Multisectoriel de la
                                <strong class="text-gray-800">Plateforme Une Seule Santé (PLUSS-CI)</strong>.
                            </p>
                            <p>
                                Son parcours au sein de la Primature remonte à 2017, où elle débute comme Chargée d'études
                                Santé avant d'être nommée Conseillère Technique en 2018. Auparavant, elle avait servi à la
                                Présidence de la République comme Chargée d'études Santé et Affaires Sociales, et contribué
                                à des projets de santé internationale au sein de structures telles que
                                <strong class="text-gray-800">MAP International</strong> et l'<strong class="text-gray-800">Institut Pasteur de Côte d'Ivoire</strong>.
                            </p>
                            <p>
                                De <strong class="text-gray-800">2012 à 2019</strong>, elle a présidé l'Instance de
                                Coordination des subventions du <strong class="text-gray-800">Fonds Mondial (CCM Côte d'Ivoire)</strong>,
                                chargée de la gouvernance des financements destinés à la lutte contre le VIH/SIDA, la
                                tuberculose et le paludisme. Cette responsabilité de premier plan l'a imposée comme
                                interlocutrice incontournable des partenaires techniques et financiers internationaux.
                            </p>
                            <p>
                                Chercheuse rattachée à l'UFR des Sciences Pharmaceutiques et Biologiques depuis 2017, elle
                                contribue à la production scientifique en santé publique et en systèmes de santé. Son
                                engagement institutionnel s'étend à la gouvernance de plusieurs organismes publics :
                                <strong class="text-gray-800">CNAM</strong>, <strong class="text-gray-800">AIRP</strong>,
                                <strong class="text-gray-800">ARSN</strong> et <strong class="text-gray-800">NPSP-CI</strong>.
                            </p>
                            <p>
                                Titulaire d'un Diplôme d'État de Docteur en Pharmacie, d'une Maîtrise et d'un DEA en Santé
                                Publique, d'un <strong class="text-gray-800">PhD en Santé Publique (2016)</strong>, ainsi que
                                d'unités d'enseignement spécialisées en biostatistiques (Université Paris VI) et en essais
                                cliniques (Institut Pasteur de Paris), Dr Ouattara allie une solide formation académique à
                                une expertise opérationnelle reconnue.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Distinction honorifique --}}
                <div class="rounded-2xl overflow-hidden" style="background:linear-gradient(135deg,#0a5c41 0%,#1D9E75 100%);">
                    <div class="p-8 flex flex-col sm:flex-row items-center gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-full bg-white/20 flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <div class="text-center sm:text-left">
                            <p class="text-white/70 text-xs font-semibold uppercase tracking-widest mb-1">Distinction honorifique</p>
                            <h3 class="text-white font-extrabold text-xl leading-tight">Chevalier de l'Ordre National de Côte d'Ivoire</h3>
                            <p class="text-white/70 text-sm mt-1">Pour l'ensemble de ses contributions au service de l'État et à la santé des populations.</p>
                        </div>
                    </div>
                </div>

            </div>{{-- /colonne droite --}}
        </div>{{-- /flex --}}
    </div>{{-- /container --}}
</div>{{-- /bg-gray-50 --}}

</x-layout>