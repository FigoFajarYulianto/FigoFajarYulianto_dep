@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="/dashboard/sliders/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Slider</th>
                                            <th>Desktop</th>
                                            <th>Mobile</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a
                                                        href="/dashboard/sliders/{{ $row->id }}/edit">{{ $row->name }}</a>
                                                </td>
                                                <td> <img
                                                        src="{{ $row->desktop ? '/storage/' . $row->desktop : '/assets/images/noimage.jpeg' }}"
                                                        class="img-thumbnail" width="100px"></td>
                                                <td> <img
                                                        src="{{ $row->mobile ? '/storage/' . $row->mobile : '/assets/images/noimage.jpeg' }}"
                                                        class="img-thumbnail" width="100px"></td>
                                                <td>
                                                    <form action="/dashboard/sliders/{{ $row->id }}" method="post">
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
                                    {{ $sliders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
