<x-layout title="L'équipe de la Plateforme - PLUSS.CI">

    {{-- ========================================== --}}
    {{-- EN-TÊTE DE LA PAGE (HERO)                  --}}
    {{-- ========================================== --}}
    <div class="relative bg-blue-900 h-72 md:h-96 flex items-center justify-center overflow-hidden">
        {{-- ... (inchangé) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800 opacity-90"></div>
        <div class="absolute inset-0 bg-[url('/public/images/pattern.png')] opacity-10 mix-blend-overlay"></div>
        
        <div class="relative z-10 text-center px-4 mt-10">
            <span class="text-brand-orange font-bold tracking-widest uppercase text-sm mb-2 block animate-fade-in-up">Qui sommes-nous ?</span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-xl tracking-tight">
                L'équipe de la <span class="text-brand-orange">Plateforme</span>
            </h1>
            <p class="text-lg text-gray-200 mt-4 max-w-2xl mx-auto font-light">
                Découvrez les experts et professionnels dédiés qui coordonnent et animent les actions de l'approche "Une Seule Santé" en Côte d'Ivoire.
            </p>
            <div class="w-24 h-1 bg-brand-orange mx-auto mt-6 rounded-full shadow-sm"></div>
        </div>
    </div>

    {{-- Conteneur principal avec Alpine --}}
    <div x-data="{
        selectedMember: null,
        modalOpen: false,
        secretariatMembers: {{ Js::from($secretariat->map(fn($m) => [
            'name' => $m->name,
            'position' => $m->position,
            'pole' => $m->pole ?? '',
            'photo' => $m->image_path ? asset('storage/' . $m->image_path) : asset('images/default-avatar.png'),
            'description' => $m->description,
        ])) }},
        appuiMembers: {{ Js::from($appui->map(fn($m) => [
            'name' => $m->name,
            'position' => $m->position,
            'pole' => $m->pole ?? '',
            'photo' => $m->image_path ? asset('storage/' . $m->image_path) : asset('images/default-avatar.png'),
            'description' => $m->description,
        ])) }},
        openModal(member) {
            this.selectedMember = member;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.selectedMember = null;
        }
    }">

        {{-- ========================================== --}}
        {{-- SECTION 1 : SECRÉTARIAT MULTISECTORIEL     --}}
        {{-- ========================================== --}}
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 max-w-7xl">
                
                <div class="text-center mb-16">
                    <span class="text-brand-green font-bold uppercase tracking-widest text-sm">Gouvernance & Coordination</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Secrétariat Multisectoriel</h2>
                    <div class="w-16 h-1 bg-gray-300 mx-auto mt-4 rounded-full"></div>
                </div>

                @if(isset($secretariat) && $secretariat->count() > 0)
                    {{-- Grille large (3 colonnes) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        @foreach($secretariat as $index => $member)
                            <div @click="openModal(secretariatMembers[{{ $index }}])" 
                                 class="cursor-pointer bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-100 group flex flex-col h-full transform hover:-translate-y-1">
                                
                                {{-- Photo --}}
                                <div class="relative h-80 overflow-hidden bg-gray-200">
                                    @if($member->image_path)
                                        <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                            <svg class="w-20 h-20 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                    @endif
                                    {{-- Voile subtil au survol --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                </div>

                                {{-- Informations (sans description) --}}
                                <div class="p-8 text-center flex-grow flex flex-col justify-center relative bg-white">
                                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-brand-orange rounded-full shadow-sm"></div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $member->name }}</h3>
                                    <p class="text-brand-orange font-bold text-sm uppercase tracking-wider">{{ $member->position }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 italic">Les membres du secrétariat seront ajoutés prochainement.</p>
                @endif

            </div>
        </section>

        {{-- ========================================== --}}
        {{-- SECTION 2 : ÉQUIPE D'APPUI                 --}}
        {{-- ========================================== --}}
        <section class="py-20 bg-white border-t border-gray-100">
            <div class="container mx-auto px-4 max-w-7xl">
                
                <div class="text-center mb-16">
                    <span class="text-brand-orange font-bold uppercase tracking-widest text-sm">Expertise & Opérations</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Équipe d'Appui</h2>
                    <div class="w-16 h-1 bg-gray-200 mx-auto mt-4 rounded-full"></div>
                </div>

                @if(isset($appui) && $appui->count() > 0)
                    {{-- Grille plus dense (4 colonnes) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($appui as $index => $member)
                            <div @click="openModal(appuiMembers[{{ $index }}])" 
                                 class="cursor-pointer bg-gray-50 rounded-xl hover:bg-white shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-transparent hover:border-gray-100 group flex flex-col h-full">
                                
                                {{-- Photo (format carré) --}}
                                <div class="relative h-60 overflow-hidden bg-gray-200">
                                    @if($member->image_path)
                                        <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top group-hover:scale-110 transition duration-700">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                            <svg class="w-16 h-16 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Informations (sans description) --}}
                                <div class="p-6 text-center flex-grow flex flex-col">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-brand-green transition">{{ $member->name }}</h3>
                                    <p class="text-brand-orange font-semibold text-xs uppercase tracking-wide">{{ $member->position }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 italic">L'équipe d'appui sera mise à jour prochainement.</p>
                @endif

            </div>
        </section>

        {{-- ========================================== --}}
        {{-- MODALE DE DÉTAIL (Alpine)                --}}
        {{-- ========================================== --}}
        <div x-show="modalOpen" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             x-transition.opacity>
            
            {{-- Overlay --}}
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>

            {{-- Contenu de la modale --}}
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                     @click.stop>
                    
                    {{-- Bouton fermer --}}
                    <button @click="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    {{-- Contenu du membre --}}
                    <template x-if="selectedMember">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                {{-- Photo --}}
                                <div class="flex-shrink-0">
                                    <img :src="selectedMember.photo" :alt="selectedMember.name" class="w-32 h-32 md:w-48 md:h-48 object-cover rounded-lg mx-auto md:mx-0">
                                </div>
                                {{-- Infos --}}
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-gray-900" x-text="selectedMember.name"></h2>
                                    <p class="text-brand-orange font-semibold" x-text="selectedMember.position"></p>
                                    <p x-show="selectedMember.pole" class="text-gray-500 text-sm mt-1" x-text="selectedMember.pole"></p>
                                    <div class="mt-4 prose prose-sm max-w-none text-gray-700" x-html="selectedMember.description"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>{{-- Fin du conteneur Alpine --}}

</x-layout>