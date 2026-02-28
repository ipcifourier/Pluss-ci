<x-layout>
    {{-- Header --}}
    <div class="bg-blue-900 py-16 text-white text-center">
        <h1 class="text-4xl font-bold">Nos Groupes de Travail Technique</h1>
        <p class="text-blue-200 mt-4 text-lg">Découvrez les équipes qui œuvrent pour Une Seule Santé</p>
    </div>

    {{-- Content --}}
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($gtts as $gtt)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 overflow-hidden flex flex-col h-full">
                    
                    {{-- Image --}}
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        @if($gtt->cover_image)
                            <img src="{{ asset('storage/' . $gtt->cover_image) }}" alt="{{ $gtt->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Text --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $gtt->name }}</h2>
                        <p class="text-gray-600 mb-4 flex-grow line-clamp-3">
                            {{ Str::limit(strip_tags($gtt->description), 120) }}
                        </p>
                        <a href="{{ route('gtts.show', $gtt) }}" class="text-brand-orange font-bold hover:underline mt-auto flex items-center gap-1">
                            Découvrir le groupe <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun groupe de travail n'est disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>