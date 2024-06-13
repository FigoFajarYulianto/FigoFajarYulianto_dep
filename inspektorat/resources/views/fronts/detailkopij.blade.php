@extends('fronts.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-8 text-center text-uppercase">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-area pb-70">
        <div class="container">
            <div class="card mt-5 shadow">
                <div class="card-header" style="background-color: rgba(14, 29, 52, 0.9);">
                    <h5 class="my-2 text-white">DETAIL KONSULTASI</h5>
                </div>
                <div class="card-body pb-0">
                    <table class="table table-bordered small">
                        <tr>
                            <th>NAMA LENGKAP</th>
                            <td>{{ $kopij->nama }}</td>
                            <th>NIK</th>
                            <td>{{ $kopij->nik }}</td>
                        </tr>
                        <tr>
                            <th>JENIS KELAMIN</th>
                            <td>{{ $kopij->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                            <th>NO. WHATSAPP</th>
                            <td>{{ $kopij->nomor_wa }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p style="font-weight: bold;">STATUS:</p>
                                {!! $kopij->status->name ?? 'Menunggu' !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p style="font-weight: bold;">PERIHAL / JUDUL:</p>
                                {{ $kopij->judul }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p style="font-weight: bold;">KELUHAN / KONSULTASI:</p>
                                {{ $kopij->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <p style="font-weight: bold;">LAMPIRAN:</p>
                                @if ($kopij->file_ktp)
                                    <a class="me-2" href="/storage/{{ $kopij->file_ktp }}" target="_blank">
                                        <img src="/storage/{{ $kopij->file_ktp }}" alt="Foto KTP"
                                            class="img-thumbnail rounded" width="80px" height="80px">
                                    </a>
                                @endif
                                @if ($kopij->file_kk)
                                    <a class="me-2" href="/storage/{{ $kopij->file_kk }}" target="_blank">
                                        <img src="/storage/{{ $kopij->file_kk }}" alt="Foto KK"
                                            class="img-thumbnail rounded" width="80px" height="80px">
                                    </a>
                                @endif
                                @if ($kopij->file_lain1)
                                    <a class="me-2" href="/storage/{{ $kopij->file_lain1 }}" target="_blank">
                                        <img src="/storage/{{ $kopij->file_lain1 }}" alt="Foto Lain"
                                            class="img-thumbnail rounded" width="80px" height="80px">
                                    </a>
                                @endif
                                @if ($kopij->file_lain2)
                                    <a href="/storage/{{ $kopij->file_lain2 }}" target="_blank">
                                        <img src="/storage/{{ $kopij->file_lain2 }}" alt="Foto Lain"
                                            class="img-thumbnail rounded" width="80px" height="80px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            @if ($kopij->status_id != 1)
                <div class="card my-3 shadow">
                    <div class="card-header" style="background-color: rgba(14, 29, 52, 0.9);">
                        <h5 class="my-2 text-white">BALAS</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="/kopij/reply" method="post">
                            @csrf
                            <input type="hidden" name="kopij_id" id="kopij_id" value="{{ $kopij->id }}">
                            <div class="form-group mb-3">
                                <textarea required name="pesan" id="pesan" rows="5"
                                    class="form-control @error('pesan') is-invalid @enderror"></textarea>
                            </div>
                            <button type="submit" class="common-btn mb-3" style="background-color: rgba(14, 29, 52, 0.9)">Kirim</button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="mt-5">
                @foreach ($kopij->kopijitems as $item)
                    <div class="card mb-3">
                        <div class="card-header" style="background-color: rgba(14, 29, 52, 0.9);">
                            <p class="my-1 small text-white">
                                {{ $item->user->name ?? $kopij->nama }}
                                <span class="float-end">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</span>
                            </p>
                        </div>
                        <div class="card-body">
                            <p class="my-0">{{ $item->pesan }}</p>
                        </div>
                        @if ($item->user_id == null)
                            <div class="card-footer p-2">
                                <form class="float-end" action="/kopij/trash/{{ $item->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
