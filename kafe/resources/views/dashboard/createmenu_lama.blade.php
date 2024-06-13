@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/dashboard/menus" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Tambah Menu Hidangan</h4>
                    <form class="form-sample" action="/dashboard/menus/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Nama Menu</label>
                            <input class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama"
                                type="text" id="nama" value="{{ old('nama') }}" />
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <img src="/assets/images/noimage.jpeg" class="img-thumbnail photoPreview" width="100px">
                            </div>
                            <div class="col-md-10 mb-3">
                                <div class="form-group">
                                    <label for="photo">Gambar</label>
                                    <div class="input-group">
                                        <input type="file" name="photo" id="photo"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            onchange="previewImage('photo', 'photoPreview')">
                                        @error('photo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="category_id">Kategori</label>
                            <div class="col-sm-12">

                                <select class="form-control mt-1 @error('category_id') is-invalid @enderror"
                                    name="category_id" id="category_id">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($categorys as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input class="form-control mt-1 @error('harga') is-invalid @enderror" name="harga"
                                type="number" id="harga" value="{{ old('harga') }}" />
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="diskon">Diskon</label>
                            <input class="form-control mt-1 @error('diskon') is-invalid @enderror" name="diskon"
                                type="number" id="diskon" value="{{ old('diskon') }}" />
                            @error('diskon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror " name="deskripsi" id="deskripsi" rows="5"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Aktif</label>
                            <div class="col-sm-12">
                                <select name="aktif" id="aktif"
                                    class="form-control @error('aktif') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    <option value="1" {{ old('aktif') === '1' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ old('aktif') === '0' ? 'selected' : '' }}>Nonaktif
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
