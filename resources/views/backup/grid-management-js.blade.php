{{-- <script>
    let grid;
    let currentLayout = {
        rows: 2,
        cols: 2,
        totalCells: 4
    };

    let gridCells = []; // Track empty cells

    function initializeGrid() {
        if (grid) {
            grid.destroy(false);
        }

        const gridWidth = 12;
        const itemWidth = Math.floor(gridWidth / currentLayout.cols);

        grid = GridStack.init({
            column: gridWidth,
            maxRow: currentLayout.rows,
            cellHeight: '300px',
            float: true,
            disableResize: true,
            disableDrag: false,
            staticGrid: false
        });

        // Create empty grid cells
        createEmptyCells();

        return grid;
    }

    function createEmptyCells() {
        grid.removeAll();
        gridCells = [];

        for (let i = 0; i < currentLayout.totalCells; i++) {
            const row = Math.floor(i / currentLayout.cols);
            const col = i % currentLayout.cols;
            const itemWidth = Math.floor(12 / currentLayout.cols);

            const element = createEmptyCell(i);
            grid.makeWidget(element, {
                x: col * itemWidth,
                y: row,
                w: itemWidth,
                h: 1,
                autoPosition: false,
                noResize: true,
                noMove: false
            });

            gridCells.push({
                index: i,
                cameraId: null,
                element: element
            });
        }
    }

    function createEmptyCell(index) {
        const div = document.createElement('div');
        div.className = 'grid-stack-item';
        div.setAttribute('data-cell-type', 'empty');
        div.setAttribute('data-cell-index', index);
        div.innerHTML = `
        <div class="grid-stack-item-content bg-gray-100 rounded-lg flex items-center justify-center">
            <span class="text-gray-500">Camera Slot ${index + 1}</span>
        </div>
    `;
        return div;
    }

    function createCameraCell(camera, index) {
        const div = document.createElement('div');
        div.className = 'grid-stack-item';
        const canvasId = `canvas-${camera.id}`;
        div.setAttribute('gs-id', canvasId);
        div.setAttribute('data-cell-type', 'camera');
        div.setAttribute('data-camera-id', camera.id);
        div.innerHTML = `
        <div class="grid-stack-item-content relative">
            <canvas class="w-full h-full" id="${canvasId}"></canvas>
        </div>
    `;
        return div;
    }

    function changeLayout(layout) {
        const [rows, cols] = layout.split('x').map(Number);
        currentLayout = {
            rows: rows,
            cols: cols,
            totalCells: rows * cols
        };

        initializeGrid();
        saveLayout();
    }

    async function loadCameras(locationId) {
        try {
            const response = await fetch(`/dashboard/cameras?locationId=${locationId}`);
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const cameras = await response.json();
            const camerasList = document.getElementById(`cameras-${locationId}`);

            camerasList.innerHTML = cameras.map(camera => `
                <div class="camera-item cursor-pointer p-2 hover:bg-gray-100" 
                     onclick="assignCameraToNextCell(${JSON.stringify(camera).replace(/"/g, '&quot;')})"
                     data-camera-id="${camera.id}">
                    <i class="fas fa-video"></i> ${camera.ten}
                </div>
            `).join('');

            camerasList.style.display = 'block';
        } catch (error) {
            console.error('Error loading cameras:', error);
        }
    }

    function assignCameraToNextCell(camera) {
        // Find first empty cell
        const emptyCell = gridCells.find(cell => !cell.cameraId);
        if (!emptyCell) {
            alert('No empty cells available');
            return;
        }

        const row = Math.floor(emptyCell.index / currentLayout.cols);
        const col = emptyCell.index % currentLayout.cols;
        const itemWidth = Math.floor(12 / currentLayout.cols);

        // Remove empty cell widget
        grid.removeWidget(emptyCell.element);

        // Add camera widget
        const cameraElement = createCameraCell(camera, emptyCell.index);
        grid.makeWidget(cameraElement, {
            x: col * itemWidth,
            y: row,
            w: itemWidth,
            h: 1,
            autoPosition: false,
            noResize: true,
            noMove: false
        });

        // Update cell state
        emptyCell.cameraId = camera.id;
        emptyCell.element = cameraElement;

        // Initialize stream
        initializeStream(camera.id);

        saveLayout();
    }

    function initializeStream(cameraId) {
        loadPlayer({
            url: `ws://${window.location.hostname}:3000/api/stream/${cameraId}`,
            canvas: document.getElementById(`canvas-${cameraId}`)
        });
    }

    function toggleArea(element) {
        const positions = element.nextElementSibling;
        positions.style.display = positions.style.display === 'none' ? 'block' : 'none';
    }

    function togglePosition(element) {
        // Toggle active state
        document.querySelectorAll('.location-item').forEach(item => {
            item.classList.remove('active');
        });
        element.classList.add('active');

        // Toggle cameras list
        const camerasList = element.nextElementSibling;
        camerasList.style.display = camerasList.style.display === 'none' ? 'block' : 'none';
    }

    async function saveLayout() {
        try {
            const layout = grid.engine.nodes.map(node => {
                // Get the element
                const element = node.el;
                let id;

                // Check if this is a camera cell or empty cell
                const gsId = element.getAttribute('gs-id');
                if (gsId) {
                    // This is a camera cell
                    id = gsId;
                } else {
                    // This is an empty cell
                    // Get the slot number from the content
                    const slotText = element.querySelector('.grid-stack-item-content span')?.textContent;
                    const slotNumber = slotText ? slotText.match(/\d+/)[0] : node.id;
                    id = `empty-slot-${slotNumber}`;
                }

                return {
                    id: id,
                    type: gsId ? 'camera' : 'empty',
                    x: node.x,
                    y: node.y,
                    w: node.w,
                    h: node.h
                };
            });

            console.log('Saving layout:', layout); // For debugging

            const response = await fetch('/save-layout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    layout,
                    gridConfig: {
                        column: 12,
                        itemWidth: Math.floor(12 / currentLayout.cols),
                        maxRow: currentLayout.rows
                    }
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Layout saved successfully:', result);
        } catch (error) {
            console.error('Error saving layout:', error);
        }
    }

    // Initialize when document is ready
    document.addEventListener('DOMContentLoaded', async () => {
        // Initialize default grid
        initializeGrid();

        // Load saved layout
        try {
            const response = await fetch('/get-layout');
            const data = await response.json();

            if (data.gridConfig) {
                const cols = 12 / data.gridConfig.itemWidth;
                const layout = `2x${cols}`;
                changeLayout(layout);
            }
        } catch (error) {
            console.error('Error loading layout:', error);
        }

        // Setup layout option events
        document.querySelectorAll('#layoutOptions .location-item').forEach(item => {
            item.addEventListener('click', () => {
                const layout = item.getAttribute('data-layout');
                changeLayout(layout);
            });
        });
    });
</script> --}}
