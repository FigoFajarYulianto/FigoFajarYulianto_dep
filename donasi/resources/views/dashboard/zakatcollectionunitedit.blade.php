@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/zakatcollectionunits" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/zakatcollectionunits/{{ $zakatcollectionunit->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name', $zakatcollectionunit->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="province_id">Provinsi</label>
                                        <select required name="province_id" id="province_id"
                                            class="form-control mt-1 @error('province_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('province_id', $zakatcollectionunit->province_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="district_id">Kabupaten</label>
                                        <select required name="district_id" id="district_id"
                                            class="form-control mt-1 @error('district_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('district_id', $zakatcollectionunit->district_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="subdistrict_id">Kecamatan</label>
                                        <select required name="subdistrict_id" id="subdistrict_id"
                                            class="form-control mt-1 @error('subdistrict_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($subdistricts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('subdistrict_id', $zakatcollectionunit->subdistrict_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subdistrict_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group mb-3">
                                <label for="name">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ old('alamat', $zakatcollectionunit->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kontak">Kontak</label>
                                <input class="form-control mt-1 @error('kontak') is-invalid @enderror" name="kontak"
                                    type="text" id="kontak"
                                    value="{{ old('kontak', $zakatcollectionunit->kontak) }}" />
                                @error('kontak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="lokasi">Embed Lokasi</label>
                                <textarea class="form-control mt-1 @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" cols="30"
                                    rows="10">{{ old('lokasi', $zakatcollectionunit->lokasi) }}</textarea>
                                @error('lokasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div id="atf-map-area" class="mt-4">
                                {!! $zakatcollectionunit->lokasi !!}
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var HOST = "/dashboard/pages/upload"; //pass the route

            addEventListener("trix-attachment-add", function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment)
                }
            })

            function uploadFileAttachment(attachment) {
                uploadFile(attachment.file, setProgress, setAttributes)

                function setProgress(progress) {
                    attachment.setUploadProgress(progress)
                }

                function setAttributes(attributes) {
                    attachment.setAttributes(attributes)
                }
            }

            function uploadFile(file, progressCallback, successCallback) {
                var formData = createFormData(file);
                var xhr = new XMLHttpRequest();

                xhr.open("POST", HOST, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', getMeta('csrf-token'));

                xhr.upload.addEventListener("progress", function(event) {
                    var progress = event.loaded / event.total * 100
                    progressCallback(progress)
                })

                xhr.addEventListener("load", function(event) {
                    var attributes = {
                        url: xhr.responseText,
                        href: xhr.responseText + "?content-disposition=attachment"
                    }
                    successCallback(attributes)
                })

                xhr.send(formData)
            }

            function createFormData(file) {
                var data = new FormData()
                data.append("Content-Type", file.type)
                data.append("file", file)
                return data
            }

            function getMeta(metaName) {
                const metas = document.getElementsByTagName('meta');

                for (let i = 0; i < metas.length; i++) {
                    if (metas[i].getAttribute('name') === metaName) {
                        return metas[i].getAttribute('content');
                    }
                }

                return '';
            }
        })();
    </script>
@endsection
