@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/posts/create" class="ms-2"><i class="fas fa-plus-circle fa-lg"></i></a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>ID KONSUL</th>
                                <th>NAMA</th>
                                <th>LAYANAN KATEGORI</th>
                                <th>NO.TELPON</th>
                                <th>STATUS</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if (in_array('Data Konsultasi.show', $roles))
                                            <a
                                                href="/dashboard/consultations/{{ $row->id }}/edit">{{ $row->id_konsultasi }}</a>
                                        @else
                                            {{ $row->id_konsultasi }}
                                        @endif
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->servicecategory->name }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>
                                        @if ($row->status_id == 1)
                                            <span class="badge bg-warning">{{ $row->status->name }}</span>
                                        @elseif($row->status_id == 2)
                                            <span class="badge bg-success">{{ $row->status->name }}</span>
                                        @elseif($row->status_id == 3)
                                            <span class="badge bg-danger">{{ $row->status->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/dashboard/consultations/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('Data Konsultasi.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3 mb-0">
                    {{ $consultations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
