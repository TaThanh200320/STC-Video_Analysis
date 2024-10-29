<div class="flex flex-col justify-between">
    <div>
        <label for="taskId" class="form-label">Task</label>
        <select class="select2_search form-control" id="taskId" name="taskId">
            <option value="" disabled selected></option>
            @foreach ($tasks as $task)
                @if ($camera->cameraTasks[0]->pivot->tacvuid == $task->id)
                    <option {{ $camera->cameraTasks[0]->pivot->tacvuid == $task->id ? 'selected' : '' }}
                        value="{{ $camera->cameraTasks[0]->pivot->tacvuid }}"
                        data-cauhinh="{{ json_encode($camera->cameraTasks[0]->getPivotCauhinhAsArray()) }}">
                        {{ $camera->cameraTasks[0]->ten }}
                    </option>
                @else
                    <option value="{{ $task->id }}" data-cauhinh="{{ json_encode($task->cauhinh) }}">
                        {{ $task->ten }}
                    </option>
                @endif
            @endforeach
        </select>
        <div class="invalid-feedback">Please select a valid task.</div>
    </div>

    <input type="hidden" name="parameters" id="parameters">
    <div class="mt-3" x-data="{ open: false }">
        <label for="parameters" class="form-label">Parameters</label>
        <button @click="open = ! open" class="btn btn-white w-full bg-white border" type="button">
            Config parameter
        </button>

        <div x-show="open" @click.outside="open = false">
            <div
                class="fixed inset-0 h-screen z-[9999] bg-black bg-opacity-50 flex flex-col items-center justify-center">
                <div class="w-[500px] h-[70vh] bg-white rounded-md shadow-md p-4 relative">
                    <svg @click="open = ! open" class="absolute top-2 right-2 cursor-pointer w-[18px] h-[18px]">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-x">
                        </use>
                    </svg>
                    <h3 class="text-center">Config Parameters</h3>
                    <div id="keyValueContainer" class="text-black"></div>
                </div>
            </div>
        </div>
    </div>
</div>
