@extends('layouts.app')
@section('title', 'Cameras')

@section('content')
    <livewire:camera-list />
@endsection

@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2_search').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        })
    </script> --}}
    {{-- <script>
        @foreach ($cameras as $camera)
            loadPlayer({
                url: `ws://${window.location.hostname}:3000/api/stream/{{ $camera['id'] }}`,
                canvas: document.getElementById('canvas-{{ $camera['id'] }}')
            });
        @endforeach
    </script> --}}
@endsection

@section('subHeader')
    <div class="flex items-center gap-4">
        <a class="no-underline text-[#6A6E76]" href="{{ route('cameras') }}">General</a>
        <a class="no-underline text-[#6A6E76]" href="{{ route('cameras.create') }}">Add</a>
        <a class="no-underline text-[#6A6E76]" href="{{ route('cameras.detail') }}">Detail</a>
    </div>
@endsection
