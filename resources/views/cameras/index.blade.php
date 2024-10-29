@extends('layouts.app')
@section('title', 'Cameras')

@section('content')
    <livewire:camera-list />
@endsection

@section('script')
    <script>
        @foreach ($cameras as $camera)
            loadPlayer({
                url: `ws://${window.location.hostname}:3000/api/stream/{{ $camera['id'] }}`,
                canvas: document.getElementById('canvas-{{ $camera['id'] }}')
            });
        @endforeach
    </script>
@endsection

@section('subHeader')
    <div class="flex items-center gap-4">
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras') }}">General</a>
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras/create') }}">Add</a>
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras/edit') }}">Detail</a>
    </div>
@endsection
