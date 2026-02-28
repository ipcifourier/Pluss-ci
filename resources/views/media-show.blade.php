<x-layout>
    <x-slot name="title">{{ $media->title }}</x-slot>

    {{-- En-tête avec l'image de couverture floutée en fond --}}
    <div class="relative h-64 md:h-80 overflow-hidden bg-gray-900">
        @if($media->cover_image)
        <div class="absolute inset-0 bg-cover bg-center opacity-40 blur-sm transform scale-110"
             style="background-image: url('{{ asset("storage/" . $media->cover_image) }}');">
        </div>
        @endif
        
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 z-10">
            <span class="mb-4 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white text-gray-900 shadow-lg">
                @if($media->type === 'video') 📺 Vidéo
                @elseif($media->type === 'audio') 🎙️ Podcast
                @elseif($media->type === 'album') 📸 Album Photo
                @endif
            </span>

            <h1 class="text-3xl md:text-5xl font-extrabold text-white drop-shadow-md max-w-4xl">
                {{ $media->title }}
            </h1>
            
            <p class="text-gray-200 mt-2 text-sm md:text-base">
                Publié le {{ $media->published_at ? $media->published_at->format('d/m/Y') : 'Date non disponible' }}
            </p>
        </div>
    </div>

    {{-- Contenu Principal --}}
    <div class="container mx-auto px-4 py-12 max-w-5xl">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-6 md:p-10">
            
            {{-- 1. SI C'EST UN PODCAST AUDIO --}}
            @if($media->type === 'audio' && $media->audio_file)
                <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>
                        Écouter le podcast
                    </h3>
                    <audio controls class="w-full h-12 rounded-lg">
                        <source src="{{ asset('storage/' . $media->audio_file) }}" type="audio/mpeg">
                        Votre navigateur ne supporte pas le lecteur audio.
                    </audio>
                </div>
            @endif

            {{-- 2. SI C'EST UNE VIDÉO YOUTUBE --}}
            @if($media->type === 'video' && $media->video_url)
                <div class="relative pb-[56.25%] mb-8 rounded-xl overflow-hidden bg-black shadow-lg">
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <p class="text-gray-300 mb-4 text-lg">Regarder sur YouTube :</p>
                        <a href="{{ $media->video_url }}" target="_blank" rel="noopener noreferrer" class="bg-red-600 text-white px-6 py-3 rounded-full font-bold hover:bg-red-700 transition flex items-center gap-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Lancer la vidéo
                        </a>
                    </div>
                </div>
            @endif

            {{-- 3. SI C'EST UN ALBUM PHOTO --}}
            @if($media->type === 'album' && $media->gallery_images)
                @php
                    $images = is_string($media->gallery_images) 
                        ? json_decode($media->gallery_images, true) 
                        : $media->gallery_images;
                @endphp
                
                @if(!empty($images))
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 border-l-4 border-brand-orange pl-4">
                        Galerie Photos
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($images as $imagePath)
                            <div class="group relative aspect-square overflow-hidden rounded-xl cursor-pointer bg-gray-100">
                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                     alt="Photo" 
                                     loading="lazy"
                                     class="object-cover w-full h-full transform group-hover:scale-110 transition duration-500">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endif

            {{-- DESCRIPTION DU MÉDIA --}}
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($media->description)) !!}
            </div>

            {{-- BOUTON RETOUR --}}
            <div class="mt-12 pt-6 border-t border-gray-100">
                <a href="{{ url('/') }}" class="inline-flex items-center text-gray-500 hover:text-brand-orange transition font-semibold">
                    ← Retour à l'accueil
                </a>
            </div>

        </div>
    </div>
</x-layout>