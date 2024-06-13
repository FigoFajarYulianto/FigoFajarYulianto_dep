@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-10 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xl px-4 mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <a href="/" class="logo d-flex">
                </a>
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header justify-content-center">
                        <div class="cotnainer">
                            <div class="row">
                                <h3 class="fw-light my-0">Form Konsultasi</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/consultation" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="nik">NIK</label>
                                <input class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik"
                                    type="text" autofocus />
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" type="text" autofocus />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="servicecategory_id">Kategori Konsultasi</label>
                                <input style="background-color: rgb(230, 230, 230)"
                                    class="form-control @error('servicecategory_id') is-invalid @enderror" type="text"
                                    value="{{ $servicecategory->name }}" readonly />
                                <input type="hidden" name="servicecategory_id" value="{{ $servicecategory->id }}">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk"
                                    class="form-control @error('jk') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="phone">Nomor WA</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        id="phone" type="text" />
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="30"></textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="konsultasi">Konsultasi</label>
                                <textarea class="form-control" name="konsultasi" id="konsultasi" cols="30" rows="10"></textarea>
                                @error('konsultasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 text-center">
                                <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                    data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                                @error('g-recaptcha-response')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="/auth/forgot"></a>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small text-muted text-uppercase">
                            &copy; {{ date('Y') }} - DP3AKB
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
