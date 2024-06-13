@extends('dashboard.template')
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card shadow">
            <div class="card-body">
                <a href="/dashboard/sliders" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                <h4 class="card-title">Add Slider</h4>
                <form class="form-sample" action="/dashboard/sliders/{{ $slider->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Nama Slider</label>
                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name" type="text" id="name" value="{{ old('name', $slider->name) }}" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="{{$slider->desktop ? '/storage/' . $slider->desktop : '/assets/images/noimage.jpeg' }}" class="img-thumbnail desktopPreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="desktop">Slider Desktop</label>
                                <div class="input-group">
                                    <input type="file" name="desktop" id="desktop" class="form-control @error('desktop') is-invalid @enderror" onchange="previewImage('desktop', 'desktopPreview')">
                                    @error('desktop')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-2 mb-3">
                            <img src="{{$slider->mobile ? '/storage/' . $slider->mobile : '/assets/images/noimage.jpeg' }}" class="img-thumbnail mobilePreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="mobile">Slider Mobile</label>
                                <div class="input-group">
                                    <input type="file" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" onchange="previewImage('mobile', 'mobilePreview')">
                                    @error('mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection