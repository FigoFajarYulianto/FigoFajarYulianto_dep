@extends('dashboard.template')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="form-group">
                <div class="card shadow">
                    <div class="card-body">
                        <a href="/dashboard/levels" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                        <h4 class="card-title">Edit Level</h4>
                        <form action="/dashboard/levels/{{ $level->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama"
                                    type="text" id="nama" value="{{ old('nama', $level->nama) }}" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row mt-4 mb-3 ml-5">
                                @foreach ($roles as $role)
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="checkbox" class="text-capitalize">{{ $role[0]['group'] }}</label>
                                            @foreach ($role as $row)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $row['route'] }}" id="{{ $row['route'] }}" name="roles[]"
                                                        {{ in_array($row['route'], $access) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $row['route'] }}">
                                                        {{ $row['name'] }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
