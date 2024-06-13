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
                                <div class="page-header-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                Whatsapp History
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
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>Nomor</th>
                                <th>Pesan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>Nomor</th>
                                <th>Pesan</th>
                                <th>Hapus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($histories as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($row->status)
                                    <span class="badge bg-success">Terkirim</span>
                                    @else
                                    <form action="/dashboard/whatsapp/resend/{{ $row->id }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Resend</button>
                                    </form>
                                    @endif
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->number }}</td>
                                <td>{{ $row->message }}</td>
                                <td>
                                    <form action="/dashboard/whatsapp/destroy/{{ $row->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin melanjutkan?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3 mb-0">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </main>
</div>
@endsection