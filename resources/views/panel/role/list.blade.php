@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">Role List</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                @if (!empty($PermissionAdd))
                                    <a class="btn btn-primary" style="margin-top: 10px"
                                        href="{{ url('panel/role/add') }}">Add</a>
                                @endif
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    {{-- @if (!empty($PermissionEdit) || !empty($PermissionDelete)) --}}
                                    <th scope="col">Action</th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                    <tr>
                                        <th scope="row">{{ $value->id }}</th>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>
                                            {{-- @if (!empty($PermissionEdit)) --}}
                                            <a href="{{ url('panel/role/edit/' . $value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            {{-- @endif --}}
                                            {{-- @if (!empty($PermissionDelete)) --}}
                                            <a href="{{ url('panel/role/delete/' . $value->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection