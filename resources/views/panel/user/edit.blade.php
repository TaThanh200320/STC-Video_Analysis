@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Edit User</h1>
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
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>

                        <!-- General Form Elements -->
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label"><b>Name</b></label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" value="{{ $getRecord->name }}" required
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label"><b>Email</b></label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" value="{{ $getRecord->email }}" readonly
                                        class="form-control">
                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label"><b>Password</b></label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" class="form-control">
                                    (Do you want to change password please add. Otherwise, live it.)
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label"><b>Status</b></label>
                                <div class="col-sm-12">
                                    <select name="status" id="" class="form-control">
                                        <option value="active">Active
                                        </option>
                                        <option value="inactive">Inactive
                                        </option>
                                    </select>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-12 col-form-label"><b>Role</b></label>
                                        <div class="col-sm-12">
                                            <select name="role_id" id="" class="form-control">
                                                @foreach ($getRole as $item)
                                                    <option {{ $getRecord->role_id == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
