@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Group
                            <a href="{{ route('cameras.groups') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('cameras/groups/' . $group->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $group->ten }}" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <input type="text" name="description" value="{{ $group->mota }}" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="type" class="mb-1">Type</label>
                                <select required name="type" class="form-control" aria-label="Default select example">
                                    @if ($group->loainhom == 'khuvuc')
                                        <option value="khuvuc">Area</option>
                                        <option value="chucnang">Function</option>
                                    @else
                                        <option value="chucnang">Function</option>
                                        <option value="khuvuc">Area</option>
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid group.
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
