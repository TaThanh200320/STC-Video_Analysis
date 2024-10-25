@extends('layouts.app')
@section('title', 'Cameras')

@section('content')
    <div>
        <a href="{{ url('cameras/create') }}" class="btn btn-primary float-end">Add Camera</a>
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
