<x-layout>
    <x-slot:title>Contactez-nous - PLUSS CI</x-slot>

    {{-- BANNIÈRE --}}
    <div class="relative overflow-hidden py-14 md:py-20 text-white" style="background: linear-gradient(135deg, #0a5c41 0%, #1D9E75 60%, #25b585 100%);">
        {{-- Cercles décoratifs --}}
        <div class="absolute -top-10 -left-10 w-56 h-56 rounded-full bg-white/5 pointer-events-none"></div>
        <div class="absolute -bottom-16 -right-16 w-72 h-72 rounded-full bg-white/5 pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            {{-- Breadcrumb --}}
            <nav class="flex justify-center items-center gap-2 text-white/70 text-sm mb-5">
                <a href="{{ url('/') }}" class="hover:text-white transition">Accueil</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Contact</span>
            </nav>

            {{-- Icône --}}
            <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-white/15 flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight mb-3">Contactez-nous</h1>
            <p class="text-white/80 text-base md:text-lg max-w-xl mx-auto">
                Une question, un partenariat ou une information ? Notre équipe est à votre écoute.
            </p>
        </div>

        {{-- Vague de transition --}}
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 40" preserveAspectRatio="none" class="w-full h-8 md:h-10" fill="white">
                <path d="M0,32 C360,0 1080,60 1440,20 L1440,40 L0,40 Z"/>
            </svg>
        </div>
    </div>

    {{-- CONTENU --}}
    <div class="max-w-6xl mx-auto px-4 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-10 items-start">

            {{-- COLONNE GAUCHE : FORMULAIRE (3/5) --}}
            <div class="lg:col-span-3 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

                {{-- En-tête formulaire --}}
                <div class="px-6 py-5 border-b border-gray-100" style="background: linear-gradient(90deg, #f0fdf4, #ffffff);">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center shrink-0" style="background:#1D9E75;">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </span>
                        Envoyez-nous un message
                    </h2>
                </div>

                <div class="p-6 md:p-8">
                    {{-- Message de succès --}}
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="font-bold text-sm">Message envoyé avec succès !</p>
                                <p class="text-sm mt-0.5">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Nom + Email sur 2 colonnes --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#1D9E75] focus:ring-2 focus:ring-[#1D9E75]/20 px-4 py-2.5 text-sm transition"
                                    placeholder="Jean Dupont">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Adresse Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#1D9E75] focus:ring-2 focus:ring-[#1D9E75]/20 px-4 py-2.5 text-sm transition"
                                    placeholder="vous@exemple.com">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Sujet --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sujet</label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#1D9E75] focus:ring-2 focus:ring-[#1D9E75]/20 px-4 py-2.5 text-sm transition"
                                placeholder="Demande d'information, partenariat…">
                        </div>

                        {{-- Message --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Votre message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="6" required
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#1D9E75] focus:ring-2 focus:ring-[#1D9E75]/20 px-4 py-2.5 text-sm transition resize-none"
                                placeholder="Comment pouvons-nous vous aider ?">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 text-white font-bold py-3 rounded-xl transition duration-300 shadow-md hover:shadow-lg hover:opacity-90"
                            style="background: linear-gradient(90deg, #1D9E75, #0a5c41);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>

            {{-- COLONNE DROITE : MAP + COORDONNÉES (2/5) --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Carte Google Maps --}}
                <div class="rounded-2xl overflow-hidden shadow-lg h-64 lg:h-72 border border-gray-100">
                    <iframe
                        src="https://maps.google.com/maps?q=5.378080,-3.998552(Plateforme%20Une%20Seule%20Sant%C3%A9%20-%20C%C3%B4te%20d%27Ivoire)&z=16&output=embed"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                {{-- Coordonnées --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100" style="background: linear-gradient(90deg, #f0fdf4, #ffffff);">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center" style="background:#1D9E75;">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            Nos Coordonnées
                        </h3>
                    </div>
                    <ul class="divide-y divide-gray-50">
                        <li class="flex items-start gap-3 px-5 py-4">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background:#f0fdf4;">
                                <svg class="w-4 h-4" style="color:#1D9E75;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-800">Adresse</p>
                                <p class="text-gray-500 mt-0.5">Abidjan, Côte d'Ivoire</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 px-5 py-4">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background:#f0fdf4;">
                                <svg class="w-4 h-4" style="color:#1D9E75;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-800">Téléphone</p>
                                <p class="text-gray-500 mt-0.5">+225 01 02 03 04 05</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 px-5 py-4">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background:#f0fdf4;">
                                <svg class="w-4 h-4" style="color:#1D9E75;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="text-sm text-gray-700">
                                <p class="font-semibold text-gray-800">Email</p>
                                <p class="text-gray-500 mt-0.5">secretariat@pluss.ci</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-layout>