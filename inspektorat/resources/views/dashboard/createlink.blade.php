@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-uppercase">
                    <a href="/dashboard/links" class="mr-1">
                        <i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </h4>
                <form action="/dashboard/links/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Judul</label>
                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name" type="text"
                            id="name" value="{{ old('name') }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="/admin/img/noimage.jpeg" class="img-thumbnail imagePreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <div class="input-group">
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        onchange="previewImage('image', 'imagePreview')">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="link">URL / Link</label>
                        <input class="form-control mt-1 @error('link') is-invalid @enderror" name="link" type="text"
                            id="link" value="{{ old('link') }}" />
                        @error('link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
