@extends('dashboard.template')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="message-circle"></i></div>
                                Balasan Konsultasi
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Tambah
                        <a href="/dashboard/consultationreplies/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <table id="datatablesSimple">
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
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Consultation Id</th>
                                <th>User Id</th>
                                <th>Lampiran</th>
                                <th>Pesan</th>
                                <th>Hapus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($consultationreplies as $row)
                            <tr>
                                <td scope="row">
                                    {{ $consultationreplies->firstItem() + $loop->index }}
                                </td>
                                <td><a href="/dashboard/consultationreplies/{{ $row->id }}/edit">{{ $row->consultation_id }}</a>
                                </td>
                                <td>{{ $row->user_id }}</td>
                                <td>{{ $row->lampiran }}</td>
                                <td>{{ $row->pesan }}</td>
                                <td>
                                    <form action="/dashboard/consultationreplies/{{ $row->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection