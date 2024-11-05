@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-2">
        <!-- Sidebar -->
        <div class="col-span-3 shadow-md p-3">
            <div class="layout-options">
                <h5 class="text-lg font-semibold mb-2">Layout</h5>
                <div id="layoutOptions">
                    <div class="location-item cursor-pointer p-2 hover:bg-gray-100" data-layout="2x2">
                        <i class="fas fa-th"></i> 2x2
                    </div>
                    <div class="location-item cursor-pointer p-2 hover:bg-gray-100" data-layout="2x3">
                        <i class="fas fa-th"></i> 2x3
                    </div>
                    <div class="location-item cursor-pointer p-2 hover:bg-gray-100" data-layout="2x4">
                        <i class="fas fa-th"></i> 2x4
                    </div>
                </div>
            </div>

            <div class="location-tree mt-4">
                <h5 class="text-lg font-semibold mb-2">Locations</h5>
                <div id="locationTree">
                    @foreach ($locations as $area)
                        <div class="area-group">
                            <div class="location-item cursor-pointer p-2 hover:bg-gray-100" onclick="toggleArea(this)">
                                <i class="fas fa-building"></i>
                                {{ $area['label'] }}
                            </div>
                            <div class="positions" style="padding-left: 1.5rem;">
                                @foreach ($area['positions'] as $position)
                                    <div class="position-group">
                                        <div class="location-item cursor-pointer p-2 hover:bg-gray-100"
                                            data-position-id="{{ $position['id'] }}" onclick="togglePosition(this)">
                                            <i class="fas fa-video"></i>
                                            {{ $position['label'] }} ({{ $position['camera_count'] }})
                                        </div>
                                        <div class="cameras-list" id="cameras-{{ $position['id'] }}"
                                            style="padding-left: 1.5rem; display: none;">
                                            @foreach ($position['cameras'] as $camera)
                                                <div class="camera-item cursor-pointer p-2 hover:bg-gray-100"
                                                    onclick="assignCameraToNextCell({{ json_encode($camera) }})"
                                                    data-camera-id="{{ $camera['id'] }}">
                                                    <i class="fas fa-video"></i>
                                                    {{ $camera['label'] }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-span-9">
            <div class="grid-stack"></div>
        </div>
    </div>
@endsection

<script src="node_modules/gridstack/dist/gridstack-all.js"></script>
<script src="js/grid-management.min.js"></script>
