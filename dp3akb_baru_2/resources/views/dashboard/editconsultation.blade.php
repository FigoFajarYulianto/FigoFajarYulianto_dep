@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/consultations" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        Edit Konsultasi
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/consultations/{{ $consultation->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="id_konsultasi">ID Konsultasi</label>
                                        <input class="form-control mt-1 @error('id_konsultasi') is-invalid @enderror"
                                            name="id_konsultasi" type="text" id="id_konsultasi"
                                            value="{{ old('id_konsultasi', $consultation->id_konsultasi) }}" readonly />
                                        @error('id_konsultasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nik">NIK</label>
                                        <input class="form-control mt-1 @error('nik') is-invalid @enderror" name="nik"
                                            type="text" id="nik" value="{{ old('nik', $consultation->nik) }}"
                                            readonly />
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name', $consultation->name) }}" readonly />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="service_id">Layanan</label>
                                        <input class="form-control mt-1 @error('service_id') is-invalid @enderror"
                                            name="service_id" type="text" id="service_id"
                                            value="{{ old('service_id', $consultation->servicecategory->service->name) }}"
                                            readonly />
                                        @error('service_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Kategori Layanan</label>
                                        <input class="form-control mt-1 @error('servicecategory_id') is-invalid @enderror"
                                            name="servicecategory_id" type="text" id="servicecategory_id"
                                            value="{{ old('servicecategory_id', $consultation->servicecategory->name) }}"
                                            readonly />
                                        @error('servicecategory_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="jk">Jenis Kelamin</label>
                                        <input class="form-control mt-1 @error('jk') is-invalid @enderror" name="jk"
                                            type="text" id="jk" value="{{ old('jk', $consultation->jk) }}"
                                            readonly />
                                        @error('jk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email">Email</label>
                                        <input class="form-control mt-1 @error('email') is-invalid @enderror" name="email"
                                            type="text" id="email" value="{{ old('email', $consultation->email) }}"
                                            readonly />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone">No. Telepon</label>
                                        <input class="form-control mt-1 @error('phone') is-invalid @enderror" name="phone"
                                            type="text" id="phone" value="{{ old('phone', $consultation->phone) }}"
                                            readonly />
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" readonly>{{ $consultation->alamat }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Konsultasi</label>
                                <textarea name="konsultasi" id="konsultasi" cols="30" rows="10" class="form-control" readonly>{{ $consultation->konsultasi }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_id">Status</label>
                                <select name="status_id" id="status_id"
                                    class="form-control @error('status_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($statuses as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $row->id == $consultation->status_id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="jawaban">Balas</label>
                                <textarea name="jawaban" id="jawaban" class="form-control" cols="30" rows="10">{{ old('jawaban', $consultation->jawaban) }}</textarea>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Kirim</button>
                        </form>
                    </div>
                </div>

                @foreach ($consultation->consultationreplies as $item)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h4 class="my-0 small">
                                <i class="fas fa-user me-2"></i> {{ $item->user->name ?? $consultation->name }}
                                <span class="float-end small">
                                    {{ date('d/m/Y H:i', strtotime($item->created_at)) }}
                                </span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <p class="my-0">{{ $item->jawaban }}</p>
                        </div>
                        <div class="card-footer">
                            <form action="/dashboard/consultations/reply/{{ $item->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm float-end"
                                    onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                        data-feather="trash-2"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        (function() {
            var HOST = "/dashboard/posts/upload"; //pass the route

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

@section('script')
    <script>
        function previewImage(fieldId, previewClass) {
            const image = document.querySelector('#' +
                fieldId);
            const imgPreview = document.querySelector('.' + previewClass);

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(img) {
                imgPreview.src = img.target.result;
            }
        }
    </script>
@endsection
