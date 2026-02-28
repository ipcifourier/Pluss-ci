<footer class="bg-gray-900 text-white pt-16 pb-8 border-t-4 border-brand-orange">
    <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            
            {{-- COLONNE 1 : INFOS --}}
            <div>
                <h3 class="text-2xl font-bold mb-4 text-white">PLUSS.CI</h3>
                <p class="text-gray-400 leading-relaxed mb-6">
                    Plateforme Une Seule Santé Côte d'Ivoire. <br>
                    Ensemble pour une santé globale.
                </p>
                <div class="flex space-x-4">
                    {{-- Icônes Réseaux Sociaux --}}
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-brand-orange transition group">
                        <svg class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>

            {{-- COLONNE 2 : NAVIGATION --}}
            <div>
                <h4 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2 inline-block">Navigation</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Accueil</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Contact</a></li>
                </ul>
            </div>

            {{-- COLONNE 3 : LIENS UTILES --}}
            <div>
                <h4 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2 inline-block">Liens Utiles</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> Ministère de la Santé</a></li>
                    <li><a href="#" class="hover:text-brand-orange transition flex items-center gap-2"><span class="text-brand-orange">›</span> OMS / FAO / OIE</a></li>
                </ul>
            </div>

            {{-- COLONNE 4 : NEWSLETTER --}}
            <div>
                <h4 class="text-lg font-semibold mb-6 border-b border-gray-700 pb-2 inline-block">Newsletter</h4>
                <p class="text-gray-400 text-sm mb-4">Abonnez-vous pour recevoir nos rapports et actualités.</p>
                <form action="{{ route('subscribe') }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    <input type="email" name="email" required placeholder="Votre adresse email" class="bg-gray-800 border border-gray-700 text-white px-4 py-2 rounded focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition text-sm">
                    <button type="submit" class="bg-brand-orange text-white px-4 py-2 rounded font-bold uppercase text-sm tracking-wide hover:bg-orange-600 transition">S'inscrire</button>
                </form>
            </div>

        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} PLUSS.CI - Tous droits réservés.
        </div>
    </div>
</footer>