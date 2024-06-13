@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    {{ $title_bar }}
                    <a href="/dashboard/letters/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table id="customTable" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Pengirim OPD</th>
                                    <th>Pengirim Non OPD</th>
                                    <th>Tgl. Surat</th>
                                    <th>No. Surat</th>
                                    <th>Tgl. Diterima</th>
                                    <th>Perihal</th>
                                    <th>Tgl. Disposisi Inspektur</th>
                                    <th>Disposisi Inspektur</th>
                                    <th>Irban Penerima</th>
                                    <th>Nama Penerima</th>
                                    <th>Keterangan</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($letters as $row)
                                    <tr style="vertical-align: top;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="/dashboard/letters/{{ $row->id }}/edit">{{ $row->nomor }}</a>
                                        </td>
                                        <td>{{ $row->pengirim_opd ?? '-' }}</td>
                                        <td>{{ $row->pengirim_nonopd ?? '-' }}</td>
                                        <td>
                                            {{ $row->tgl_surat ? date('d/m/Y', strtotime($row->tgl_surat)) : '-' }}
                                        </td>
                                        <td>{{ $row->nomor_surat ?? '-' }}</td>
                                        <td>
                                            {{ $row->tgl_diterima ? date('d/m/Y', strtotime($row->tgl_diterima)) : '-' }}
                                        </td>
                                        <td>{{ $row->perihal ?? '-' }}</td>
                                        <td>
                                            {{ $row->tgl_disposisi ? date('d/m/Y', strtotime($row->tgl_disposisi)) : '-' }}
                                        </td>
                                        <td>{{ $row->disposisi ?? '-' }}</td>
                                        <td>{{ $row->irban->name ?? '-' }}</td>
                                        <td>{{ $row->nama_penerima ?? '-' }}</td>
                                        <td>{{ $row->keterangan ?? '-' }}</td>
                                        <td>
                                            <form action="/dashboard/letters/{{ $row->id }}" method="post">
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
                    <div class="d-flex justify-content-end mt-3 mb-0">
                        {{ $letters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
