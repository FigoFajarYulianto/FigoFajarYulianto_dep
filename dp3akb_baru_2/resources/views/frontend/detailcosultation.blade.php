@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/page-header.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
                        <h2 style="font-size: 32px;">{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            {!! session('msg') !!}
            <form action="/consultation/reply/{{ $consultation->id }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id_konsultasi">ID Konsultasi</label>
                            <input class="form-control mt-1 mt-1 @error('id_konsultasi') is-invalid @enderror"
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
                            <input class="form-control mt-1 mt-1 @error('nik') is-invalid @enderror" name="nik"
                                type="text" id="nik" value="{{ old('nik', $consultation->nik) }}" readonly />
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
                    <input class="form-control mt-1 mt-1 @error('name') is-invalid @enderror" name="name" type="text"
                        id="name" value="{{ old('name', $consultation->name) }}" readonly />
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
                            <input class="form-control mt-1 mt-1 @error('service_id') is-invalid @enderror"
                                name="service_id" type="text" id="service_id"
                                value="{{ old('service_id', $consultation->servicecategory->service->name) }}" readonly />
                            @error('service_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name">Kategori Layanan</label>
                            <input class="form-control mt-1 mt-1 @error('servicecategory_id') is-invalid @enderror"
                                name="servicecategory_id" type="text" id="servicecategory_id"
                                value="{{ old('servicecategory_id', $consultation->servicecategory->name) }}" readonly />
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
                            <input class="form-control mt-1 mt-1 @error('jk') is-invalid @enderror" name="jk"
                                type="text" id="jk" value="{{ old('jk', $consultation->jk) }}" readonly />
                            @error('jk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email</label>
                            <input class="form-control mt-1 mt-1 @error('email') is-invalid @enderror" name="email"
                                type="text" id="email" value="{{ old('email', $consultation->email) }}" readonly />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="phone">No. Telepon</label>
                            <input class="form-control mt-1 mt-1 @error('phone') is-invalid @enderror" name="phone"
                                type="text" id="phone" value="{{ old('phone', $consultation->phone) }}" readonly />
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
                    <textarea name="alamat" id="alamat" rows="3" class="form-control mt-1" readonly>{{ $consultation->alamat }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="">Konsultasi</label>
                    <textarea name="konsultasi" id="konsultasi" rows="10" class="form-control mt-1" readonly>{{ $consultation->konsultasi }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="jawaban">Balas</label>
                    <textarea name="jawaban" id="jawaban" class="form-control mt-1" rows="10">{{ old('jawaban', $consultation->jawaban) }}</textarea>
                    @error('jawaban')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mb-5">Kirim</button>
            </form>

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
                    @if ($item->user_id == null)
                        <div class="card-footer">
                            <form action="/consultation/reply/{{ $item->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm float-end"
                                    onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </section>
@endsection
