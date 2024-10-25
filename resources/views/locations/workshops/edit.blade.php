@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Workshop
                            <a href="{{ route('locations.workshops') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('locations/workshops/' . $workshop->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="ten" value="{{ $workshop->ten }}" class="form-control" />
                                @error('ten')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Code</label>
                                <input type="text" name="ma" value="{{ $workshop->ma }}" class="form-control" />
                                @error('ma')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <input type="text" name="mota" value="{{ $workshop->mota }}" class="form-control" />
                                @error('mota')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Areas</label>
                                <select name="area" class="form-control" aria-label="Default select example">
                                    @if ($oldArea)
                                        <option value="{{ $oldArea->id }}">{{ $oldArea->ten }}</option>
                                    @else
                                        <option value="">Select the area</option>
                                    @endif
                                    @foreach ($areas as $area)
                                        @if ($oldArea)
                                            @if ($oldArea->id == $area->id)
                                                @continue
                                            @endif
                                        @endif
                                        <option value="{{ $area->id }}">{{ $area->ten }}</option>
                                    @endforeach
                                </select>
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
