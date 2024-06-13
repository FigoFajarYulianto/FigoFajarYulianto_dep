@extends('dashboard.template')
@section('content')
    <h2 class="page-header-title">
        <div class="page-header-icon"><i data-feather="activity"></i></div>
        Konsultasi
    </h2>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">Tambah Konsultasi
                            <a href="/dashboard/konsultasi/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                        Pencarian :
                                        <div class="col-auto">
                                            <form action="/dashboard/konsultasi" method="GET">
                                                <input type="search" id="" name="search" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <table class="display expandable-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Judul</th>
                                                <th>Whatsapp</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($consultation as $row)
                                                <tr>
                                                    <td scope="row">{{ $consultation->firstItem() + $loop->index }}</td>
                                                    <td><a
                                                            href="/dashboard/konsultasi/{{ $row->id }}/edit">{{ $row->nama }}</a>
                                                    </td>
                                                    <td>{{ $row->alamat }}</td>
                                                    <td>{{ $row->judul }}</td>
                                                    <td>{{ $row->whatsapp }}</td>
                                                    <td>
                                                        <form action="/dashboard/konsultasi/{{ $row->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        <p>Showing
                                            {{ $consultation->firstItem() }}
                                            To
                                            {{ $consultation->lastItem() }}
                                            Of
                                            {{ $consultation->total() }}
                                        </p>
                                    </div>
                                    <div class="pull-right">
                                        {{ $consultation->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
