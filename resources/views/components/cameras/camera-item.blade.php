@props(['camera'])
<div class="bg-white rounded-lg shadow overflow-hidden">
    <!-- Camera Preview (placeholder) -->
    <div class="aspect-video bg-gray-100 flex items-center justify-center">
        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
        <canvas class="!w-full !h-full" id="canvas-{{ $camera['id'] }}"></canvas>
    </div>

    <!-- Camera Info -->
    <div class="p-3">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $camera->ten }}</h3>

        <div class="space-y-2 text-sm text-gray-600">
            <div class="flex items-center">
                <span class="font-medium mr-2">Group:</span>
                {{ $camera->group->ten ?? 'N/A' }}
            </div>
            <div class="flex items-center">
                <span class="font-medium mr-2">Position:</span>
                {{ $camera->position->ten ?? 'N/A' }}
            </div>
            <div class="flex items-center">
                <span class="font-medium mr-2">Status:</span>
                <span
                    class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $camera->trangthai ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $camera->trangthai ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-4 flex items-center justify-end space-x-2">
            {{-- @can('update camera') --}}
            <a class="nav-link" href="{{ url('cameras/' . $camera->id . '/edit') }}">
                <svg class="!w-[24px] !h-[24px]">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-cog"></use>
                </svg>
            </a>
            {{-- @endcan --}}

            {{-- @can('delete camera') --}}
            <a class="nav-link" href="{{ url('cameras/' . $camera->id . '/delete') }}">
                <svg class="!w-[24px] !h-[24px]">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-trash"></use>
                </svg>
            </a>
            {{-- @endcan --}}
        </div>
    </div>
</div>
