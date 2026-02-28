{{-- resources/views/pages/events.blade.php --}}
@extends('layouts.app') {{-- ou le layout que vous utilisez --}}

@section('title', 'Événements')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tous les événements</h1>

    @forelse ($events as $event)
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
            <p class="text-gray-600 mb-2">
                <i class="far fa-calendar-alt mr-1"></i>
                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                @if($event->end_date)
                     - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                @endif
            </p>
            @if($event->location)
                <p class="text-gray-600 mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ $event->location }}
                </p>
            @endif
            <p class="text-gray-700 mb-4">{{ Str::limit($event->description, 200) }}</p>
            <a href="{{ route('evenements.show', $event->id) }}" class="text-blue-500 hover:underline">
                Lire la suite →
            </a>
        </div>
    @empty
        <p class="text-gray-500">Aucun événement à venir pour le moment.</p>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $events->links() }}
    </div>
</div>
@endsection