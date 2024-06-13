@extends('fronts.template')
@section('content')
    <?php $setting = \App\Models\Setting::firstWhere('id', 1); ?>
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-8 text-center text-uppercase">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                        <p>KONSULTASI PENGAWASAN INTERNAL INSPEKTORAT KABUPATEN JEMBER</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-info-area pt-5 mt-3 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md">
                    <p class="text-center mb-5">
                        Konsultasi Pengawasan Internal Inspektorat Kabupaten Jember
                        <br />dapat dilakukan dengan dua cara, yakni :
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-6">
                    <div class="contact-info">
                        <i class="fas fa-building" style="color: rgba(14, 29, 52, 0.9)"></i>
                        <span style="color: rgba(14, 29, 52, 0.9)">Luring</span>
                        Jam Konsultasi<br />
                        <span class="font-weight-bold my-0" style="font-size: 16px;">Senin - Jumat</span>
                        Pukul 08:00 - 10:00 WIB<br />
                        {{ $setting->address }}
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="contact-info" style="color: rgba(14, 29, 52, 0.9)">
                        <i class="fas fa-globe" style="color: rgba(14, 29, 52, 0.9)"></i>
                        <span style="color: rgba(14, 29, 52, 0.9)">Daring</span>
                        <a href="mailto:{{ $setting->email }}">
                            <i class="fas fa-envelope me-1" style="color: rgba(14, 29, 52, 0.9); font-size: 16px;"></i>
                            {{ $setting->email }}
                        </a>
                        <a target="_blank" href="https://wa.me/{{ $setting->whatsapp }}">
                            <i class="fab fa-whatsapp me-1" style="color: rgba(14, 29, 52, 0.9); font-size: 16px;"></i>
                            {{ str_replace(['62', '+62'], ['0', '0'], $setting->whatsapp) }}
                        </a>
                        atau Melalui form di bawah ini.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-area pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="/kopij" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h6 class="my-2">
                                    FORM KONSULTASI PENGAWASAN INTERNAL INSPEKTORAT KABUPATEN JEMBER ({{ $title_bar }})
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number"
                                                class="form-control mt-1 @error('nik') is-invalid @enderror" name="nik"
                                                id="nik" value="{{ old('nik') }}">
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama"
                                                id="nama" value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin"
                                                class="form-control mt-1 @error('jenis_kelamin') is-invalid @enderror">
                                                <option value="">:: Pilih ::</option>
                                                <option value="1" {{ old('jenis_kelamin') == 1 ? 'selected' : '' }}>
                                                    Laki-Laki
                                                </option>
                                                <option value="2" {{ old('jenis_kelamin') == 2 ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="nomor_wa">No. WhatsApp</label>
                                            <input type="number"
                                                class="form-control mt-1 @error('nomor_wa') is-invalid @enderror"
                                                name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa') }}">
                                            @error('nomor_wa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="judul">Perihal / Judul</label>
                                    <input type="text" class="form-control mt-1 @error('judul') is-invalid @enderror"
                                        name="judul" id="judul" value="{{ old('judul') }}">
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="deskripsi">Keluhan / Konsultasi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="10"
                                        class="form-control mt-1 @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="file_ktp">Foto KTP (Wajib diisi)</label>
                                            <input type="file" name="file_ktp" id="file_ktp"
                                                class="form-control mt-1 @error('file_ktp') is-invalid @enderror">
                                            @error('file_ktp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="file_kk">Foto KK (Opsional)</label>
                                            <input type="file" name="file_kk" id="file_kk"
                                                class="form-control mt-1 @error('file_kk') is-invalid @enderror">
                                            @error('file_kk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="file_lain1">Foto Lainnya (Jika ada)</label>
                                            <input type="file" name="file_lain1" id="file_lain1"
                                                class="form-control mt-1 @error('file_lain1') is-invalid @enderror">
                                            @error('file_lain1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="file_lain2">Foto Lainnya (Jika ada)</label>
                                            <input type="file" name="file_lain2" id="file_lain2"
                                                class="form-control mt-1 @error('file_lain2') is-invalid @enderror">
                                            @error('file_lain2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group my-3">
                                    <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror"
                                        data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @error('g-recaptcha-response')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="common-btn mt-3"
                                    style="background-color: rgba(14, 29, 52, 0.9)">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
