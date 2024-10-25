@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('cameras.groups.create') }}" class="btn btn-primary float-end">Add Group</a>
    </div>

    <table id="datatable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->ten }}</td>
                    @if ($group->mota)
                        <td>{{ $group->mota }}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $group->loainhom }}</td>
                    <td>
                        {{-- @can('update group') --}}
                        <a href="{{ url('cameras/groups/' . $group->id . '/edit') }}" class="btn btn-success">Edit</a>
                        {{-- @endcan --}}

                        {{-- @can('delete group') --}}
                        <a href="{{ url('cameras/groups/' . $group->id . '/delete') }}" class="btn btn-danger mx-2">Delete</a>
                        {{-- @endcan --}}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
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
