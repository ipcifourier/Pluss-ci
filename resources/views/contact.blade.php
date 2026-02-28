<x-layout>
    <x-slot:title>Contactez-nous - PLUSS CI</x-slot>

    {{-- En-tête --}}
    <div class="bg-gray-900 py-12 text-center">
        <h1 class="text-4xl font-extrabold text-white">Contactez-nous</h1>
        <p class="text-gray-400 mt-2">Nous sommes à votre écoute pour tous vos projets.</p>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- COLONNE GAUCHE : FORMULAIRE --}}
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Envoyez-nous un message</h2>

                {{-- Message de succès --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Succès !</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Nom --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" name="name" required class="w-full rounded-lg border-gray-300 focus:border-brand-orange focus:ring-brand-orange shadow-sm" placeholder="Votre nom">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse Email</label>
                        <input type="email" name="email" required class="w-full rounded-lg border-gray-300 focus:border-brand-orange focus:ring-brand-orange shadow-sm" placeholder="vous@exemple.com">
                    </div>

                    {{-- Sujet --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sujet</label>
                        <input type="text" name="subject" class="w-full rounded-lg border-gray-300 focus:border-brand-orange focus:ring-brand-orange shadow-sm" placeholder="Demande de devis...">
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Votre message</label>
                        <textarea name="message" rows="5" required class="w-full rounded-lg border-gray-300 focus:border-brand-orange focus:ring-brand-orange shadow-sm" placeholder="Comment pouvons-nous vous aider ?"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-brand-orange hover:bg-orange-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md">
                        Envoyer le message
                    </button>
                </form>
            </div>

            {{-- COLONNE DROITE : INFOS & MAP --}}
            <div class="space-y-8">
                
                {{-- Carte Google Maps (Centrée sur Abidjan / Cocody) --}}
                <div class="bg-gray-200 rounded-xl overflow-hidden shadow-lg h-80">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.508678070942!2d-4.0083!3d5.3489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMjAnNTYuMCJOIDTCsDAwJzI5LjkiVw!5e0!3m2!1sfr!2sci!4v1620000000000!5m2!1sfr!2sci" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>

                {{-- Coordonnées --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Nos Coordonnées</h3>
                    
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Abidjan, Cocody<br>Côte d'Ivoire</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>+225 01 02 03 04 05</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>secretariat@pluss.ci</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-layout>