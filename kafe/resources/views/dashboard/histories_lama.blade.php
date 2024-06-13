@extends('dashboard.template')
@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Dashboard
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container-xl px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-header text-uppercase">
            {{ $title_bar }}
        </div>
        <div class="card-body">
            {!! session('msg') !!}
            <div class="table-responsive">
                <table id="customTable" class="table table-bordered small" style="width:100%">
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
</div>
@endsection