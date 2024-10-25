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
                        <h4>Create Workshop
                            <a href="{{ route('locations.workshops') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('locations.workshops.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="ten" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="">Code</label>
                                <input type="text" name="ma" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <input type="text" name="mota" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Areas</label>
                                <select name="area" class="form-control" aria-label="Default select example">
                                    <option value="">Select the area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
