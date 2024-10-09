@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Edit Role</h1>
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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Role</h5>

                        <!-- General Form Elements -->
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-6 col-form-label"><b>Name</b></label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" value="{{ $getRecord->name }}" required
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-6 col-form-label"><b>Satus</b></label>
                                <div class="col-sm-12">
                                    <select name="status" class="form-control cursor-auto">
                                        <option value="active" {{ $getRecord->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ $getRecord->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label style="display: bloc; margin-bottom: 8px" for="inputText"
                                    class="col-sm-12 col-form-label"><b>Permission</b></label>
                                @foreach ($getPermission as $value)
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-3">
                                            {{ $value['name'] }}
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                @foreach ($value['group'] as $group)
                                                    @php
                                                        $checked = '';
                                                    @endphp
                                                    @foreach ($getRolePermission as $role)
                                                        @if ($role->permission_id == $group['id'])
                                                            @php
                                                                $checked = 'checked';
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    <div class="col-md-3">
                                                        <label><input type="checkbox" {{ $checked }}
                                                                value="{{ $group['id'] }}" name="permission_id[]"
                                                                id=""
                                                                style="margin-top: 8px; margin-right: 3px">{{ $group['name'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
