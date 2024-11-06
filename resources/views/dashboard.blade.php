@extends('layouts.app')

@section('content')
    <div x-data="{ toggleLeftContentBar: true, toggleRightContentBar: true }" class="h-[75vh]">
        <div class="grid grid-cols-12">
            {{-- Minimal Left Contentbar --}}
            <div :class="{ 'hidden': toggleLeftContentBar, 'p-2': !toggleLeftContentBar }">
                <i @click="toggleLeftContentBar = !toggleLeftContentBar" class="fa-solid fa-bars cursor-pointer"></i>
            </div>

            {{-- Minimal Right Contentbar --}}
            <div :class="{ 'hidden': toggleRightContentBar, 'p-2': !toggleRightContentBar }"
                class="col-span-11 flex items-center justify-end">
                <i @click="toggleRightContentBar = !toggleRightContentBar" class="fa-solid fa-bars cursor-pointer"></i>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-2 h-full">
            <!-- Left Contentbar -->
            <div x-show="toggleLeftContentBar" class="col-span-2 shadow-lg pl-3 pt-3 pb-3 pr-8 relative">
                <i @click="toggleLeftContentBar = !toggleLeftContentBar"
                    class="fa-solid fa-bars absolute top-2 right-2 cursor-pointer"></i>
                <div x-data="{ open: true }" class="layout-options">
                    <div @click="open = !open"
                        class="flex items-center justify-between hover:bg-gray-200 hover:rounded-md cursor-pointer px-2">
                        <h5 class="text-lg font-semibold mb-2">Layout</h5>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div id="layoutOptions" class="pl-6" x-show="open"
                        x-transition:enter="transition ease-in-out duration-200 transform"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in-out duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
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

                <div x-data="{ open: true }" class="location-tree mt-3">
                    <div @click="open = !open"
                        class="flex items-center justify-between hover:bg-gray-200 hover:rounded-md cursor-pointer px-2">
                        <h5 class="text-lg font-semibold mb-2">Locations</h5>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div id="locationTree" class="pl-3" x-show="open"
                        x-transition:enter="transition ease-in-out duration-200 transform"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in-out duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                        @foreach ($locations as $area)
                            <div class="area-group">
                                <div class="location-item cursor-pointer p-2 hover:bg-gray-100" onclick="toggleArea(this)">
                                    <i class="fa-solid fa-angle-right"></i>
                                    <i class="fas fa-building"></i>
                                    {{ $area['label'] }}
                                </div>
                                <div class="positions" style="padding-left: 1.5rem;">
                                    @foreach ($area['positions'] as $position)
                                        <div class="position-group">
                                            <div class="location-item cursor-pointer p-2 hover:bg-gray-100"
                                                data-position-id="{{ $position['id'] }}" onclick="togglePosition(this)">
                                                <i class="fa-solid fa-angle-right"></i>
                                                <i class="fa-solid fa-location-dot"></i>
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
            <div
                :class="{
                    'col-span-8': toggleLeftContentBar && toggleRightContentBar,
                    'col-span-10': (!toggleLeftContentBar &&
                        toggleRightContentBar) || (toggleLeftContentBar && !toggleRightContentBar),
                    'col-span-12': !
                        toggleLeftContentBar && !toggleRightContentBar
                }">
                <div class="grid-stack !h-full"></div>
            </div>

            <div x-show="toggleRightContentBar" class="col-span-2 shadow-lg pl-8 pt-3 pb-3 pr-3 relative">
                <i @click="toggleRightContentBar = !toggleRightContentBar"
                    class="fa-solid fa-bars absolute top-2 left-2 cursor-pointer"></i>
                <!-- Right content bar content -->
            </div>
        </div>
    </div>
@endsection

<script src="node_modules/gridstack/dist/gridstack-all.js"></script>
<script src="js/grid-management.min.js"></script>
