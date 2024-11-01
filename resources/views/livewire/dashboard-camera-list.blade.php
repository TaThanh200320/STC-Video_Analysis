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
        <div class="col-span-9">
            <div class="grid-stack">
                @foreach ($this->cameras as $camera)
                    <div class="grid-stack-item" gs-id="canvas-{{ $camera['id'] }}" gs-w="2">
                        <div class="grid-stack-item-content">
                            <canvas class="w-full h-full object-contain" id="canvas-{{ $camera['id'] }}"></canvas>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="node_modules/gridstack/dist/gridstack-all.js"></script>
<script>
    window.csrfToken = '{{ csrf_token() }}';
</script>
<script>
    const grid = GridStack.init({
        resizable: {
            handles: 'e,se,s,sw,w'
        }
    });

    fetch('/get-layout')
        .then(response => response.json())
        .then(data => {
            if (data.layout && Array.isArray(data.layout)) {
                data.layout.forEach(item => {
                    const gridItem = grid.engine.nodes.find(
                        node => node.el.querySelector('canvas').id === item.id
                    );
                    if (gridItem) {
                        grid.update(gridItem.el, {
                            x: item.x,
                            y: item.y,
                            w: item.w || 2,
                            h: item.h || 1
                        });
                    }
                });
            }
        })
        .catch(error => console.error('Error loading layout:', error));

    grid.on('change', function(event, items) {
        const layout = grid.engine.nodes.map(node => ({
            id: node.el.querySelector('canvas').id,
            x: node.x,
            y: node.y,
            w: node.w,
            h: node.h
        }));

        fetch('/save-layout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({
                    layout
                })
            })
            .then(response => response.json())
            .catch(error => console.error('Error saving layout:', error));
    });
</script>
