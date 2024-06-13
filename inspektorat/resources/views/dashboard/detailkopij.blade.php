@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        <a href="/dashboard/kopijs" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>

                    <div class="table-responsive">
                        <table class="display expandable-table table-bordered small p-2" style="width: 100%">
                            <tr>
                                <td style="font-weight: bold;">NAMA LENGKAP</td>
                                <td>{{ $kopij->nama }}</td>
                                <td style="font-weight: bold;">NIK</td>
                                <td>{{ $kopij->nik }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">JENIS KELAMIN</td>
                                <td>{{ $kopij->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td style="font-weight: bold;">NO. WHATSAPP</td>
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

                    <div class="row my-4">
                        <div class="col-12">
                            @if ($kopij->status_id != 1)
                                <div class="card my-3 shadow">
                                    <div class="card-header">
                                        <h5 class="my-2">BALAS</h5>
                                    </div>
                                    <div class="card-body pb-0">
                                        <form action="/dashboard/kopijs/reply" method="post">
                                            @csrf
                                            <input type="hidden" name="kopij_id" id="kopij_id"
                                                value="{{ $kopij->id }}">
                                            <div class="form-group mb-3">
                                                <textarea required name="pesan" id="pesan" rows="5"
                                                    class="form-control @error('pesan') is-invalid @enderror"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mb-3">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        @foreach ($kopij->kopijitems as $item)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <p class="my-1 small" style="font-weight: bold;">
                                        {{ $item->user->name ?? $kopij->nama }}
                                        <span
                                            class="float-end">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</span>
                                    </p>
                                </div>
                                <div class="card-body p-3">
                                    <p class="my-0">{{ $item->pesan }}</p>
                                </div>
                                @if ($item->user_id)
                                    <div class="card-footer p-2">
                                        <form class="float-end" action="/dashboard/kopijs/trash/{{ $item->id }}"
                                            method="post">
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
        </div>
    </div>
@endsection
