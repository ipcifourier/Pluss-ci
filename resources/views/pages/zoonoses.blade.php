<x-layout :title="'Zoonoses prioritaires - PLUSS.CI'">

{{-- ========================================== --}}
{{-- EN-TÊTE DE LA PAGE (HERO AVEC IMAGE)       --}}
{{-- ========================================== --}}
<div class="relative h-72 md:h-96 flex items-center justify-center overflow-hidden bg-cover bg-center"
     style="background-image: url('{{ asset('images/zoonoses-banner.png') }}');">
    
    {{-- Superposition sombre pour lisibilité --}}
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    
    <div class="relative z-10 text-center px-4">
        <span class="text-brand-orange font-bold tracking-widest uppercase text-sm mb-2 block">Une Seule Santé</span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-xl tracking-tight">
            Zoonoses <span class="text-brand-orange">Prioritaires</span>
        </h1>
        <p class="text-lg text-gray-200 mt-4 max-w-2xl mx-auto font-light">
            Maladies transmissibles entre l'animal et l'homme : identification, prévention et riposte.
        </p>
        <div class="w-24 h-1 bg-brand-orange mx-auto mt-6 rounded-full shadow-sm"></div>
    </div>
</div>

{{-- ========================================== --}}
{{-- PROFIL DE LA CÔTE D'IVOIRE (STATIQUE)      --}}
{{-- ========================================== --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="prose prose-lg max-w-none">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Côte d'Ivoire : Profil du pays</h2>
            <p class="text-gray-700 leading-relaxed text-justify">
                La Côte d'Ivoire est un pays situé sur la côte de l'Afrique de l'Ouest avec une population de 29 389 millions d'habitants. Dans le cadre de la mise en œuvre du Règlement Sanitaire International (RSI), la Côte d'Ivoire a adhéré au Programme de Sécurité Sanitaire Mondiale (GHSA). GHSA est une initiative multisectorielle qui vise à renforcer la capacité du pays à prévenir, détecter et répondre aux menaces sanitaires, que ces menaces soient d'origine animale, humaine ou environnementale, à travers l'approche « Une Seule Santé ».
            </p>
            <p class="text-gray-700 leading-relaxed mt-4 text-justify">
                A travers cette initiative, le gouvernement de Côte d'Ivoire a identifié cinq groupes de maladies prioritaires à potentiel épidémique ou maladies zoonotiques prioritaires (MZP). Sous la direction du groupe de travail technique sur la communication des risques, les parties prenantes de Une Seule Santé ont élaboré une stratégie de communication nationale pour permettre aux populations de prendre les décisions appropriées face à ces menaces sanitaires.
            </p>
        </div>
    </div>
</section>

{{-- ========================================== --}}
{{-- LISTE DES ZOONOSES AVEC ACCORDÉON          --}}
{{-- ========================================== --}}
@if($zoonoses->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Maladies zoonotiques prioritaires</h2>

        <div class="space-y-4">
            @foreach($zoonoses as $zoonose)
                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    {{-- En-tête cliquable --}}
                    <button @click="open = !open" class="w-full text-left px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3">
                            @if($zoonose->icone)
                                <i class="{{ $zoonose->icone }} text-brand-orange text-xl"></i>
                            @else
                                <svg class="w-6 h-6 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            @endif
                            <h3 class="text-xl font-bold text-gray-800">{{ $zoonose->titre }}</h3>
                        </div>
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Contenu déroulant --}}
                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-gray-100">
                        <div class="px-6 py-5">
                            @if($zoonose->description_courte)
                                <p class="text-gray-600 italic mb-4 border-l-4 border-brand-orange pl-4">{{ $zoonose->description_courte }}</p>
                            @endif
                            
                            @if($zoonose->image_illustration)
                                <img src="{{ asset('storage/' . $zoonose->image_illustration) }}" alt="{{ $zoonose->titre }}" class="w-full max-w-md h-auto object-cover rounded-lg mb-4 mx-auto">
                            @endif
                            
                            <div class="prose max-w-none text-gray-700">
                                {!! $zoonose->contenu !!}
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
{{-- LIEN VERS LA STRATÉGIE NATIONALE           --}}
{{-- ========================================== --}}
<section class="py-12 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4 text-center">
        <p class="text-gray-600 mb-4">
            Pour plus de détails, consultez la <span class="font-semibold">stratégie nationale de communication pour les risques liés aux cinq groupes de zoonoses prioritaires en Côte d'Ivoire (2019-2022)</span>.
        </p>
        <!--a href="#" class="inline-flex items-center gap-2 text-brand-orange font-semibold hover:underline">
            Télécharger le document
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </a-->

       
    </div>
</section>

</x-layout>