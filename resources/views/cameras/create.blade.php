@extends('layouts.app')

@section('content')
    <div class="h-[80%]">
        <div class="h-full">
            <div class="w-full h-[400px] mb-3">
                <img src="images/test-detect.png" alt="" class="w-full max-h-full object-cover">
            </div>

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div>
                <h4>Configuration</h4>
                <form action="{{ url('cameras') }}" method="POST">

                    @csrf

                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-3">
                            <h5>Vision task</h5>
                            <div class="flex flex-col justify-between">
                                <div>
                                    <label for="taskId" class="form-label">Task</label>
                                    <select class="form-select" id="taskId" name="taskId">
                                        <option selected disabled value="">Choose...</option>
                                        {{-- @foreach ($tasks as $task)
                                            <option value="{{ $task->id }}">{{ $task->name }}</option>
                                        @endforeach --}}
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid task.
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="taskName" class="form-label">Task name</label>
                                    <input type="text" class="form-control" id="taskName" name="taskName" value=""
                                        placeholder="Following route 1">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <select class="js-example-basic-single" name="state">
                                        <option value="AL">Alabama</option>
                                        ...
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-span-9">
                            <h5>Metadata</h5>
                            <div class="grid grid-cols-12 gap-3">
                                <div class="col-span-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value=""
                                        placeholder="MKK052 Pano 7000" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-span-4">
                                    <label for="location" class="form-label">Location</label>
                                    <x-hierarchical-select :areas="$areas" />
                                </div>

                                <div class="col-span-4">
                                    <label for="path" class="form-label">Path</label>
                                    <input type="text" class="form-control" id="path" name="path" value=""
                                        placeholder="The end part of URL" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-span-4">
                                    <label for="ipAddress" class="form-label">Ip address</label>
                                    <input type="text" class="form-control" id="ipAddress" name="ipAddress"
                                        value="" placeholder="192.168.8.191" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-span-4">
                                    <label for="port" class="form-label">Port</label>
                                    <input type="text" class="form-control" id="port" name="port" value=""
                                        placeholder="554" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-span-4">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value=""
                                        placeholder="admin" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-span-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-span-4">
                                    <label for="groupId" class="form-label">Group</label>
                                    <select name="groupId" class="form-control" aria-label="Default select example">
                                        <option value="">Select camera group</option>
                                        <option disabled class="text-gray-400">Area Group</option>
                                        @foreach ($groups as $group)
                                            @if ($group->loainhom == 'chucnang')
                                                @continue
                                            @endif
                                            <option value="{{ $group->id }}">
                                                {{ $group->ten }}
                                            </option>
                                        @endforeach
                                        <hr>
                                        <option disabled class="text-gray-400">Function Group</option>
                                        @foreach ($groups as $group)
                                            @if ($group->loainhom == 'khuvuc')
                                                @continue
                                            @endif
                                            <option class="!pl-[10px]" value="{{ $group->id }}">{{ $group->ten }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid group.
                                    </div>
                                </div>
                                <div class="col-span-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value="hoatdong">Run</option>
                                        <option value="ngunghoatdong">Stop</option>
                                        <option value="dacauhinh">Active</option>
                                        <option value="chuacauhinh">Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid status.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md mt-3">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection

@section('subHeader')
    <div class="flex items-center gap-4">
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras') }}">General</a>
        <a class="no-underline text-[#6A6E76]" href="{{ route('cameras.groups') }}">Group</a>
        <a class="no-underline text-[#6A6E76]" href="{{ route('cameras.tasks') }}">Task</a>
        <a class="no-underline text-[#6A6E76]" href="{{ url('/cameras/create') }}">Setting</a>
        <a class="no-underline text-[#6A6E76]" href="#">Recording</a>
    </div>
@endsection
