@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/pages" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <form action="/dashboard/pages/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Judul</label>
                        <input class="form-control mt-1 @error('title') is-invalid @enderror" name="title" type="text"
                            id="title" value="{{ old('title') }}" />
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="/assets/images/noimage.jpeg" class="img-thumbnail imagePreview" width="100px">
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
                        <label for="body">Konten</label>
                        <textarea class="ckeditor form-control @error('body') is-invalid @enderror" name="body" id="body">{{ old('body') }}</textarea>
                        @error('body')
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
