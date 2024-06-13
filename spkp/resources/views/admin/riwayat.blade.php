@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    {{ $title_bar }}
                    <a href="/admin/riwayats/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped text-center display nowrap w-100"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tahun</th>
                                    <th>Nilai</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($terpilihs as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="/admin/riwayats/{{ $row->id }}/edit">{{ $row->nama }}</a></td>
                                        <td>{{ $row->tahun }}</td>
                                        <td>{{ number_format($row->nilai, 4, ',', '.') }}</td>
                                        <td>
                                            <form action="/admin/riwayats/{{ $row->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{--  <div class="pull-right">
                                    {{ $riwayats->links() }}
                                </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
