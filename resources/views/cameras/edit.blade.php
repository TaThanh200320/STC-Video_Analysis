@extends('layouts.app')

@section('content')
    <div class="h-[80%]">
        <div class="h-full">
            <div class="w-full h-[400px] mb-3 bg-gray-200 flex items-center justify-center">
                {{-- <svg class="h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg> --}}
                <canvas class="!w-[600px] !h-full" id="canvas-{{ $camera->id }}"></canvas>
            </div>

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div>
                <form action="{{ url('cameras/' . $camera->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-12 gap-3">
                        {{-- Task --}}
                        <div class="col-span-3">
                            <h5>Vision task</h5>
                            @include('cameras.partials.update.task')
                        </div>

                        {{-- Metadata --}}
                        <div class="col-span-9">
                            <h5>Metadata</h5>
                            @include('cameras.partials.update.metadata')
                        </div>
                    </div>

                    <div class="col-md mt-3 w-full flex items-end justify-end">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2_search').select2({
                placeholder: "Select an option",
                allowClear: true
            });

            updateParams()

            $('.select2_search').on('select2:select', function(e) {
                updateParams();
            });

            function updateParams() {
                const taskSelect = document.getElementById('taskId');
                const parametersInput = document.getElementById('parameters');
                const selectedOption = taskSelect.options[taskSelect.selectedIndex];
                const cauhinhData = selectedOption.getAttribute('data-cauhinh');
                console.log("Cấu hình Data:", cauhinhData);

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
                const parametersInput = document.getElementById('parameters');

                document.querySelectorAll('.parameter-input').forEach(input => {
                    const key = input.getAttribute('data-key');
                    parameters[key] = input.value;
                });

                parametersInput.value = JSON.stringify(parameters);
            }

            window.updateParametersValue = updateParametersValue;
        });
    </script>
    <script>
        loadPlayer({
            url: `ws://${window.location.hostname}:3000/api/stream/{{ $camera['id'] }}`,
            canvas: document.getElementById('canvas-{{ $camera['id'] }}')
        });
    </script>
@endsection

@section('subHeader')
    <div class="flex items-center gap-4">
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras') }}">General</a>
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras/create') }}">Add</a>
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras/edit') }}">Detail</a>
    </div>
@endsection
