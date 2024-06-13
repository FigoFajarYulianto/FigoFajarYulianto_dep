@extends('layouts.admin')
@section('content')
    <form class="form-sample" action="/admin/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>User Edit</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama</label>
                    <div class="col-9">
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                            value="{{ old('name', $user->name) }}" id="name" name="name">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                            value="{{ old('email', $user->email) }}" id="email" name="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3 col-form-label">Password</label>
                    <div class="col-9">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password"
                            name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="widget-footer text-right">
                <button type="submit" class="btn btn-primary mr-2">Perbarui</button>

            </div>
        </div>
    </form>
@endsection
