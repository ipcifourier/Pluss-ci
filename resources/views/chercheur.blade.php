<x-layout>
    <x-slot name="title">Espace Chercheurs — PLUSS-CI</x-slot>

    <section class="min-h-[60vh] flex items-center justify-center bg-gray-50">
        <div class="text-center px-6">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-teal-50 mb-6">
                <svg class="w-10 h-10 text-[#1D9E75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-4">Espace Chercheurs</h1>
            <p class="text-lg text-gray-500 font-medium">Espace en cours de développement.</p>
            <p class="text-sm text-gray-400 mt-2">Revenez bientôt pour accéder aux ressources scientifiques PLUSS-CI.</p>
            <a href="{{ route('home') }}"
                class="mt-8 inline-flex items-center gap-2 bg-[#1D9E75] text-white px-6 py-3 rounded-full font-semibold hover:bg-[#0a5c41] transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </section>
</x-layout>
