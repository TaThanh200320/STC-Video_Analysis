@extends('layouts.app')
@section('content')
    @livewire('dashboard-camera-list')
@endsection


{{-- @section('script')
    <script>
        @foreach ($cameras as $camera)
            loadPlayer({
                url: `ws://${window.location.hostname}:3000/api/stream/{{ $camera['id'] }}`,
                canvas: document.getElementById('canvas-{{ $camera['id'] }}')
            });
        @endforeach
    </script>
@endsection --}}
