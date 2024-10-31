<div class="">
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-3 h-[450px] relative p-3 bg-[#212631] text-white">
            <button class="absolute top-1 right-2">
                <svg class="icon">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-menu"></use>
                </svg>
            </button>
            <h4>Navigation</h4>
        </div>

        <div class="col-span-9 grid grid-cols-{{ $this->layout / 2 }}">
            @foreach ($this->cameras as $camera)
                <div class="border p-4">
                    {{ $camera->ten }}
                </div>
            @endforeach
        </div>
    </div>
</div>
