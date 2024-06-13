@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    {{ $title_bar }}
                    <a href="/dashboard/laporandarurats/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table id="customTable" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kejadian</th>
                                    <th>Telepon</th>
                                    <th>Pukul</th>
                                    <th>Tanggal</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporandarurats as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a
                                                href="/dashboard/laporandarurats/{{ $row->id }}/edit">{{ $row->name }}</a>
                                        </td>
                                        <td>{{ $row->judul }}</td>
                                        <td>{{ $row->telepon }}</td>
                                        <td>{{ $row->pukul }}</td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($row->tanggal))->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $row->kecamatan->name }}</td>
                                        <td>{{ $row->desa->name }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>{{ $row->status->name ?? '' }}</td>
                                        <td>
                                            <form action="/dashboard/laporandarurats/{{ $row->id }}" method="post">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
