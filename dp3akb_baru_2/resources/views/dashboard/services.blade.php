@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                Layanan
                <span class="ml-5">
                    <a href="/dashboard/services/create" class="ms-2"><i class='fas fa-plus-circle fa-lg'></i></a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>NO</th>
                                <th>LAYANAN</th>
                                <th>LIHAT</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $row)
                                <tr>
                                    <td scope="row">{{ $services->firstItem() + $loop->index }}</td>
                                    <td>
                                        <a href="/dashboard/services/{{ $row->id }}/edit">{{ $row->name }}</a>
                                    </td>
                                    <td>
                                        <a href="/services/{{ $row->slug }}" target="_blank"><i
                                                class="fa fa-external-link"></i></a>
                                    </td>
                                    <td>
                                        <form action="/dashboard/services/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?');">
                                                <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <p>Showing
                            {{ $services->firstItem() }}
                            To
                            {{ $services->lastItem() }}
                            Of
                            {{ $services->total() }}
                        </p>
                    </div>
                    <div class="pull-right">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
