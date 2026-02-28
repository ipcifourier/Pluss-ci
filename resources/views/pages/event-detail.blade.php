{{-- resources/views/pages/event-detail.blade.php --}}
@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <article class="bg-white shadow-lg rounded-lg overflow-hidden">
        @if($event->cover_image)
            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover">
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>

            <div class="flex items-center text-gray-600 mb-4">
                <i class="far fa-calendar-alt mr-2"></i>
                <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y H:i') }}</span>
            </div>

            <div class="prose max-w-none">
                {!! $event->content !!}
            </div>

            <div class="mt-6">
                <a href="{{ route('evenements') }}" class="text-blue-500 hover:underline">
                    ← Retour aux événements
                </a>
            </div>
        </div>
    </article>
</div>
@endsection