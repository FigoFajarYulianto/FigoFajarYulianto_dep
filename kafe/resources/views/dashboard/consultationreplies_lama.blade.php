@extends('dashboard.template')
@section('content')
    <h2 class="page-header-title">
        <div class="page-header-icon"><i data-feather="activity"></i></div>
        Balasan Konsultasi
    </h2>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">Tambah
                            <a href="/dashboard/consultationreplies/create" class="ms-6"><i
                                    class="fa fa-plus-circle"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                        Pencarian :
                                        <div class="col-auto">
                                            <form action="/dashboard/consultationreplies" method="GET">
                                                <input type="search" id="" name="search" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <table class="display expandable-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Consultation Id</th>
                                                <th>User Id</th>
                                                <th>Lampiran</th>
                                                <th>Pesan</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($consultationreplies as $row)
                                                <tr>
                                                    <td scope="row">
                                                        {{ $consultationreplies->firstItem() + $loop->index }}</td>
                                                    <td><a
                                                            href="/dashboard/consultationreplies/{{ $row->id }}/edit">{{ $row->consultation_id }}</a>
                                                    </td>
                                                    <td>{{ $row->user_id }}</td>
                                                    <td>{{ $row->lampiran }}</td>
                                                    <td>{{ $row->pesan }}</td>
                                                    <td>
                                                        <form action="/dashboard/consultationreplies/{{ $row->id }}"
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
                                            {{ $consultationreplies->firstItem() }}
                                            To
                                            {{ $consultationreplies->lastItem() }}
                                            Of
                                            {{ $consultationreplies->total() }}
                                        </p>
                                    </div>
                                    <div class="pull-right">
                                        {{ $consultationreplies->links() }}
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
