@extends('layouts.app')
@section('content')
    {{-- <div class="grid grid-cols-12 gap-3">
        @foreach ($cameras as $camera)
            <div class="col-span-4">
                <canvas class="!w-full !h-[360px]" id="canvas-{{ $camera['id'] }}"></canvas>
            </div>
        @endforeach
    </div> --}}
    <div class="flex justify-end">
        <form id="layoutForm" action="{{ route('dashboard.update-layout') }}" method="POST" class="inline">
            @csrf
            @method('PUT')
            <select name="layout" class="form-select mb-3" onchange="this.form.submit()">
                <option value="4" {{ $layout == 4 ? 'selected' : '' }}>4 Cameras</option>
                <option value="6" {{ $layout == 6 ? 'selected' : '' }}>6 Cameras</option>
                <option value="8" {{ $layout == 8 ? 'selected' : '' }}>8 Cameras</option>
            </select>
        </form>
    </div>

    @livewire('dashboard-camera-list')
@endsection

{{-- 
@section('script')
    <script>
        @foreach ($cameras as $camera)
            loadPlayer({
                url: `ws://${window.location.hostname}:3000/api/stream/{{ $camera['id'] }}`,
                canvas: document.getElementById('canvas-{{ $camera['id'] }}')
            });
        @endforeach
    </script>
@endsection --}}
