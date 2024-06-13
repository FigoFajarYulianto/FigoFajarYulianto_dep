@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {!! session('msg') !!}
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
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
                                                        <form action="/dashboard/whatsapp/resend/{{ $row->id }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Resend</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->number }}</td>
                                                <td>{{ $row->message }}</td>
                                                <td>
                                                    <form action="/dashboard/whatsapp/destroy/{{ $row->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                                class="fa fa-trash"></i></button>
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
            </div>
        </div>
    </div>
@endsection
