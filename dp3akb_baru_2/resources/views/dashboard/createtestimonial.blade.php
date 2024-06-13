@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/testimonials" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/testimonials" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="title">Gelar / Jabatan</label>
                                <input class="form-control mt-1 @error('title') is-invalid @enderror" name="title"
                                    type="text" id="title" value="{{ old('title') }}" />
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="/assets/img/noimage.jpeg" class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('desktop') is-invalid @enderror"
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
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" rows="10"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rateStar" class="small">1 Bintang: Mengecewakan, 5 Bintang: Mantap!</label>
                                <input required id="rateStar" name="rateStar" class="rating rating-loading"
                                    data-show-clear="false" data-show-caption="false">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
