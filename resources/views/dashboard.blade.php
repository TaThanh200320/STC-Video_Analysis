@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-3">
        @foreach ($cameras as $camera)
            <div class="col-span-4">
                <h2>{{ $camera['name'] }}</h2>
                <canvas class="!w-full !h-[360px]" id="canvas-{{ $camera['id'] }}"></canvas>
            </div>
        @endforeach
    </div>
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
