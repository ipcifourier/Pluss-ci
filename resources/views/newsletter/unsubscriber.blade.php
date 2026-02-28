<x-layout>
    <x-slot:title>Désinscription confirmée - PLUSS CI</x-slot>

    <div class="min-h-[60vh] flex flex-col items-center justify-center bg-gray-50 px-4 text-center">
        
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-xl max-w-lg w-full">
            <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">Désinscription réussie</h1>
            
            <p class="text-gray-600 mb-8">
                Votre adresse email a bien été retirée de notre liste de diffusion. 
                Vous ne recevrez plus nos actualités.
            </p>

            <div class="border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-400 mb-4">C'était une erreur ?</p>
                <a href="{{ route('home') }}#newsletter" class="inline-block bg-brand-orange text-white px-6 py-3 rounded-lg font-bold hover:bg-orange-600 transition">
                    Se réabonner
                </a>
            </div>
            
            <div class="mt-6">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-900 text-sm underline">
                    Retour à l'accueil
                </a>
            </div>
        </div>

    </div>
</x-layout>