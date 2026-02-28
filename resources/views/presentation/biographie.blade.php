<x-layout>
    <x-slot:title>Biographie Dr Djeneba OUATTARA - PLUSS CI</x-slot>

    {{-- En-tête --}}
    <div class="bg-gray-900 py-12 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-white">Biographie de la Coordonnatrice</h1>
        <div class="w-24 h-1 bg-brand-orange mx-auto mt-4 rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- COLONNE GAUCHE : PHOTO & IDENTITÉ --}}
            <div class="w-full lg:w-1/3 shrink-0">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-8">
                    <div class="h-96 bg-gray-200 relative group">
                        {{-- 👇 TA PHOTO ICI --}}
                        <img src="{{ asset('images/cordo.png') }}" 
                             alt="Dr Djeneba OUATTARA" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-8 text-center bg-white relative">
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-orange text-white px-4 py-2 rounded-full font-bold shadow-md text-sm uppercase tracking-wider">
                            Docteur
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mt-4">Djeneba OUATTARA</h2>
                        <p class="text-gray-500 font-medium mb-6">Coordonnatrice Générale</p>
                    </div>
                </div>
            </div>

            {{-- COLONNE DROITE : DÉTAILS --}}
            <div class="w-full lg:w-2/3 space-y-12">
                
                {{-- Intro --}}
                <div class="prose prose-lg text-gray-600 text-justify">
                    <p class="lead text-xl text-gray-800 font-semibold">
                        Figure emblématique de notre structure, <span class="text-brand-orange">Dr Djeneba OUATTARA</span> incarne le leadership et la vision stratégique de la Plateforme Une Seule Santé.
                    </p>
                    <p>
                        Forte d'une solide expérience académique et professionnelle, elle assure la coordination générale des activités
                    </p>
                </div>

                {{-- Résumé --}}
                <div class="bg-white p-8 rounded-xl shadow-sm border-l-4 border-brand-orange">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">RESUME DU PARCOURS PROFESSIONNEL</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-4">
                            <span class="font-bold text-brand-orange">La Coordonnatrice</span>
                            <div>
                                <h4 class="font-bold text-gray-900">Docteur en Pharmacie et PhD en Santé Publique</h4>
                                <p class="text-gray-600 text-sm">Université Félix Houphouët-Boigny</p>
                                <p class="text-gray-800 mt-2">Spécialisation en épidémiologie et gestion des risques sanitaires</p>
                                <p class="text-gray-800 mt-1">
                                Avec plus de 26 ans d'expérience et un Doctorat en Santé publique, Dr Djénéba OUATTARA est une figure incontournable de la santé publique en Côte d'Ivoire. Enseignante-chercheure et défenseure des soins de santé primaires, 
                                elle plaide pour des réformes inclusives et pérennes afin d'améliorer durablement la qualité de vie des populations.
                                Elle a occupé des postes stratégiques, notamment celui de présidente de l'Instance de Coordination des Subventions du Fonds mondial en Côte d'Ivoire, 
                                qu'elle a dirigée pendant sept ans. Actuellement, en tant que Conseillère auprès du Premier Ministre en charge de la Santé, de l'Hygiène publique et de la Nutrition, elle est à la tête de réformes stratégiques incluant la modernisation du système hospitalier, la réorganisation du secteur pharmaceutique et le déploiement de la Couverture Maladie Universelle (CMU).
                                En parallèle, Dr OUATTARA coordonne deux plateformes nationales :
                                    <ul class="list-disc list-inside mt-2">
                                        <li class="text-gray-800 font-semibold">La Plateforme Nationale de Coordination du Financement de la Santé (PNCFS), qui œuvre pour réduire la mortalité maternelle et infantile tout en améliorant la santé des femmes, des adolescents et des enfants.</li>
                                        <li class="text-gray-800 font-semibold">•	La Plateforme Nationale Une Seule Santé, axée sur une approche multisectorielle pour prévenir, détecter et répondre aux crises sanitaires, notamment celles à l’interface entre santé humaine, animale et environnementale.</li>
                                    </ul>

                                </p>
                                <h3 class="text-xl font-bold text-gray-800 mt-4">Visionneuse et engagée</h3>
                                <p class="text-gray-800 mt-2 text-justify">
                                    Dr Djénéba OUATTARA est reconnue pour son engagement indéfectible envers la santé publique et sa capacité à mobiliser les ressources et les acteurs autour d'objectifs communs. Sa vision pour PLUSS CI est de faire de la plateforme un levier opérationnel dans le domaine du One Health, en renforçant les synergies entre les secteurs de la santé humaine, animale et environnementale pour une meilleure prévention et gestion des crises sanitaires.</p>
                                
                                <h3 class="text-xl font-bold text-gray-800 mt-4">Domaines d'expertise</h3>
                                <ul class="list-disc list-inside mt-2">
                                    <li class="text-gray-800">Santé publique et épidémiologie</li>
                                    <li class="text-gray-800">Nutrition</li>
                                    <li class="text-gray-800">Coordination intersectorielle et gestion des crises sanitaires</li>
                                    <li class="text-gray-800">Réforme strategique dans le secteur de la santé</li>
                                </ul>

                                <h3 class="text-xl font-bold text-gray-800 mt-4">Expériences pertinentes</h3>
                                <ul class="list-disc list-inside mt-2">
                                    <li class="text-gray-800">Présidente de l'Instance de Coordination des Subventions du Fonds mondial en Côte d'Ivoire (7 ans)</li>
                                    <li class="text-gray-800">Conseillère auprès du Premier Ministre en charge de la Santé, de la Nutrition et de la protection sociale</li>
                                    <li class="text-gray-800">Coordonnatrice de la Plateforme Nationale de Coordination du Financement de la Santé (PNCFS)</li>
                                    <li class="text-gray-800">Point focal GFF</li>
                                    <li class="text-gray-800">Coordonnatrice de la Plateforme Nationale Une Seule Santé</li>

                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Vision --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Sa Vision</h3>
                    <p class="text-gray-600 leading-relaxed bg-white p-6 rounded-xl shadow-sm border border-gray-100 italic">
                        "Faire de PLUSS CI un levier opérationnel dans le domaine du One Health..."
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>