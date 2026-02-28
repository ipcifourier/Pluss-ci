<x-layout 
    :title="($page->title ?? 'Présentation') . ' - PLUSS.CI'"
>

    {{-- ================================================================= --}}
    {{-- CONDITION : S'il s'agit du Mot de la Coordonnatrice ou du Ministre --}}
    {{-- ================================================================= --}}
    @if(Str::contains(strtolower($page->title ?? ''), ['mot', 'coordonnatrice', 'ministre']))
        
        <div class="py-16 md:py-24 bg-gray-50 min-h-screen flex items-center">
            <div class="container mx-auto px-4 max-w-6xl">
                
                {{-- La Grande Carte Profil --}}
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100">
                    
                    {{-- Côté Gauche : La Photo (Portrait) --}}
                    <div class="md:w-2/5 relative bg-blue-900 min-h-[400px]">
                        @if(isset($page->image) && $page->image)
                            <img src="{{ Storage::url($page->image) }}" class="absolute inset-0 w-full h-full object-cover object-top" alt="Portrait">
                        @elseif(isset($page->cover_image) && $page->cover_image)
                            <img src="{{ Storage::url($page->cover_image) }}" class="absolute inset-0 w-full h-full object-cover object-top" alt="Portrait">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-700"></div>
                        @endif
                        
                        {{-- Voile dégradé en bas de la photo pour faire ressortir le nom si vous l'ajoutez plus tard --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-transparent to-transparent"></div>
                    </div>

                    {{-- Côté Droit : Le Message --}}
                    <div class="md:w-3/5 p-8 md:p-14 relative flex flex-col justify-center">
                        
                        {{-- Grosse Icône de Citation (Guillemets) en arrière-plan --}}
                        <svg class="absolute top-8 left-8 w-32 h-32 text-gray-100 opacity-60 pointer-events-none" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        
                        <div class="relative z-10">
                            {{-- Le Titre (ex: Mot de la Coordonnatrice) --}}
                            <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-2">{{ $page->title }}</h1>
                            <div class="w-16 h-1.5 bg-brand-orange mb-8 rounded-full"></div>
                            
                            {{-- Le Contenu Filament --}}
                            <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed italic prose-p:mb-6">
                                {!! $page->content ?? $page->description !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    {{-- ================================================================= --}}
    {{-- SINON : Le design standard (Nos Objectifs, etc.) qu'on a déjà fait --}}
    {{-- ================================================================= --}}
    @else
        
        <div class="relative bg-blue-900 h-72 md:h-96 flex items-center justify-center overflow-hidden">
            @if(isset($page->image) && $page->image)
                <img src="{{ Storage::url($page->image) }}" class="absolute inset-0 w-full h-full object-cover object-center opacity-50">
            @elseif(isset($page->cover_image) && $page->cover_image)
                <img src="{{ Storage::url($page->cover_image) }}" class="absolute inset-0 w-full h-full object-cover object-center opacity-50">
            @else
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800 opacity-90"></div>
            @endif
            
            <div class="absolute inset-0 bg-blue-900/40 mix-blend-multiply"></div>
            
            <div class="relative z-10 text-center px-4 mt-10">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-xl tracking-tight">
                    {{ $page->title ?? 'Présentation' }}
                </h1>
                <div class="w-24 h-1 bg-brand-orange mx-auto mt-6 rounded-full shadow-sm"></div>
            </div>
        </div>

        <div class="py-16 bg-gray-50 min-h-screen">
            <div class="container mx-auto px-4 max-w-4xl relative -mt-24 z-20">
                <div class="bg-white rounded-xl shadow-xl border border-gray-100 border-t-8 border-t-blue-900 p-8 md:p-12 lg:p-16">
                    <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed prose-headings:text-blue-900 prose-a:text-brand-orange">
                        {!! $page->content ?? $page->description !!}
                    </div>
                </div>
            </div>
        </div>

    @endif

</x-layout>