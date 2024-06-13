@extends('dashboard.template')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Menu
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">


                    <a href="/dashboard/levels" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Edit Level</h4>
                    <form action="/dashboard/levels/{{ $level->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama" type="text" id="nama" value="{{ old('nama', $level->nama) }}" />
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
                                        <input class="form-check-input" type="checkbox" value="{{ $row['route'] }}" id="{{ $row['route'] }}" name="roles[]" {{ in_array($row['route'], $access) ? 'checked' : '' }}>
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
    </main>
</div>
@endsection