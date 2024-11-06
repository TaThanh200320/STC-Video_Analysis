<div class="col-span-3">
    <h5>Vision task</h5>
    <div class="flex flex-col justify-between">
        <div>
            <label for="taskId" class="form-label">Task</label>
            <select class="form-select" id="taskId" name="taskId" onchange="updateParams()">
                <option selected disabled value="">Choose...</option>
                @foreach ($tasks as $task)
                    <option value="{{ $task->id }}" data-cauhinh="{{ json_encode($task->cauhinh) }}">
                        {{ $task->ten }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a valid task.</div>
        </div>

        <input type="hidden" name="parameters" id="parameters">
        <div x-data="{ open: false }" @keydown.escape.window="open = false" class="mt-3">
            <label for="parameters" class="form-label">Parameters</label>
            <button @click="open = !open" class="btn btn-white w-full bg-white border" type="button">
                Config parameter
            </button>

            <div x-show="open" @click.away="open = false">
                <div
                    class="fixed inset-0 h-screen z-[9999] bg-black bg-opacity-50 flex flex-col items-center justify-center">
                    <div class="w-[500px] h-[70vh] bg-white rounded-md shadow-md p-4 relative" @click.stop>
                        <svg @click="open = false" class="absolute top-2 right-2 cursor-pointer w-[18px] h-[18px]">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-x"></use>
                        </svg>
                        <h3 class="text-center">Config Parameters</h3>
                        <div id="keyValueContainer" class="text-black"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const taskSelect = document.getElementById('taskId');
        const parametersInput = document.getElementById('parameters');

        if (taskSelect) {
            taskSelect.addEventListener('change', updateParams);
        }

        function updateParams() {
            const selectedOption = taskSelect.options[taskSelect.selectedIndex];
            const cauhinhData = selectedOption.getAttribute('data-cauhinh');

            let config;
            try {
                config = JSON.parse(cauhinhData);
            } catch (error) {
                console.error('Invalid JSON in data-cauhinh:', error);
                config = {};
            }

            const keyValueContainer = document.getElementById("keyValueContainer");
            keyValueContainer.innerHTML = '';

            for (const key in config) {
                if (config.hasOwnProperty(key)) {
                    keyValueContainer.innerHTML += `
                        <div class="parameter-group">
                            <label class="form-label mt-3">${key}</label>
                            <input class='form-control parameter-input' 
                                   data-key="${key}"
                                   value='${config[key] || ''}'
                                   onchange="updateParametersValue()">
                        </div>`;
                }
            }

            updateParametersValue();
        }

        function updateParametersValue() {
            const parameters = {};

            document.querySelectorAll('.parameter-input').forEach(input => {
                const key = input.getAttribute('data-key');
                parameters[key] = input.value;
            });

            parametersInput.value = JSON.stringify(parameters);
        }
    });
</script>
