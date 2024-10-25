@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('locations.workshops.create') }}" class="btn btn-primary float-end">Add Workshop</a>
    </div>

    @php
        $hasArea = $workshops->contains(function ($workshop) {
            return $workshop->area;
        });
    @endphp

    <table id="datatable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                @if ($hasArea)
                    <th>Area</th>
                @endif
                <th>Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workshops as $workshop)
                <tr>
                    <td>{{ $workshop->id }}</td>
                    <td>{{ $workshop->ten }}</td>
                    <td>{{ $workshop->mota }}</td>

                    @if ($hasArea)
                        @if ($workshop->area)
                            <td>{{ $workshop->area->ten }}</td>
                        @else
                            <td></td>
                        @endif
                    @endif

                    <td>{{ $workshop->ma }}</td>
                    <td>
                        {{-- @can('update workshop') --}}
                        <a href="{{ url('locations/workshops/' . $workshop->id . '/edit') }}" class="btn btn-success">Edit</a>
                        {{-- @endcan --}}

                        {{-- @can('delete workshop') --}}
                        <a href="{{ url('locations/workshops/' . $workshop->id . '/delete') }}"
                            class="btn btn-danger mx-2">Delete</a>
                        {{-- @endcan --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('subHeader')
    <div class="flex items-center gap-4">
        <a class="no-underline text-[#6A6E76]" href="{{ route('locations.areas') }}">Areas</a>
        <a class="no-underline text-[#6A6E76]" href="{{ route('locations.workshops') }}">Workshops</a>
        <a class="no-underline text-[#6A6E76]" href="{{ route('locations.positions') }}">Positions</a>
    </div>
@endsection
