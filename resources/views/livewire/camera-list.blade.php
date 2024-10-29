<div class="px-4">
    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar Filters - 3 cols -->
        <div class="h-[550px] col-span-3 bg-white rounded-lg shadow p-4">
            <x-cameras.search :sort="$this->sort" :search="$this->search" :groupId="$this->groupId" :positionId="$this->positionId"
                :taskId="$this->taskId" />
        </div>

        <!-- Camera Grid - 9 cols -->
        <div class="col-span-9">
            <div class="grid grid-cols-3 gap-6">
                @foreach ($this->cameras as $camera)
                    <x-cameras.camera-item wire:key="{{ $camera->id }}" :camera="$camera" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $this->cameras->links() }}
            </div>
        </div>
    </div>
</div>