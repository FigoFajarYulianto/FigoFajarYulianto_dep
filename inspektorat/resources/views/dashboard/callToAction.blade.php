@extends('dashboard.template')
@section('content')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>

    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    {{ $title_bar }}
                </div>
                <form action="/dashboard/callToActions/{{ $callToActions->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Judul</label>
                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name" type="text"
                            id="name" value="{{ old('name', $callToActions->name) }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="{{ $callToActions->image ? '/storage/' . $callToActions->image : '/admin/img/noimage.jpeg' }}"
                                class="img-thumbnail imagePreview" width="100px">
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
                        <input type="hidden" name="description" id="description"
                            value="{{ old('description', $callToActions->description) }}">
                        <trix-editor input="description"></trix-editor>
                        @error('description')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="link">URL / Link</label>
                        <input class="form-control mt-1 @error('link') is-invalid @enderror" name="link" type="text"
                            id="link" value="{{ old('link', $callToActions->link) }}" />
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
@section('script')
    <script>
        (function() {
            var HOST = "/dashboard/callToAction/upload"; //pass the route

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
