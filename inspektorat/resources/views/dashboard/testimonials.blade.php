@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        {{-- <a href="/dashboard/testimonials/create" class="ml-1"><i class="fa fa-plus-circle"></i></a> --}}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Testimoni</th>
                                            <th>Rating</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a
                                                        href="/dashboard/testimonials/{{ $row->id }}/edit">{{ $row->name }}</a>
                                                </td>
                                                <td>{{ $row->description ? $row->description : '-' }}</td>
                                                <td>{{ $row->star }} <i class="fa fa-star text-warning"></i></td>
                                                <td>
                                                    <form action="/dashboard/testimonials/{{ $row->id }}"
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
                                <div class="pull-right">
                                    {{ $testimonials->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
