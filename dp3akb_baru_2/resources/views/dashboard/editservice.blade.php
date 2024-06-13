@extends('dashboard.template')
@section('content')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/services" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        Edit Service
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/services/{{ $service->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Judul</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name', $service->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $service->image ? '/storage/' . $service->image : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview" width="100px">
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
                                <label for="postcategory_id">Kategori</label>
                                <select name="postcategory_id" id="postcategory_id"
                                    class="form-control mt-1 @error('postcategory_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $row->id == $service->postcategory_id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('postcategory_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <input type="hidden" name="description" id="description"
                                    value="{{ old('description', $service->description) }}">
                                <trix-editor input="description"></trix-editor>
                                @error('description')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
