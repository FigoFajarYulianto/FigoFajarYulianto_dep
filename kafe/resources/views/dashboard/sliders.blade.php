@extends('dashboard.template')
@section('content')
<h2 class="page-header-title">
    <div class="page-header-icon"><i data-feather="activity"></i></div>
    Slider
</h2>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">Slider
                        <a href="/dashboard/sliders/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                    Pencarian :
                                    <div class="col-auto">
                                        <form action="/dashboard/sliders" method="GET">
                                            <input type="search" id="" name="search" class="form-control">
                                        </form>
                                    </div>
                                </div>
                                <table class="display expandable-table" style="width: 100%">
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
                                            <td scope="row">{{ $sliders->firstItem() + $loop->index }}</td>
                                            <td><a href="/dashboard/sliders/{{ $row->id }}/edit">{{ $row->name }}</a>
                                            </td>
                                            <td> <img src="{{ $row->desktop ? '/storage/' . $row->desktop : '/assets/images/noimage.jpeg' }}" class="img-thumbnail" width="100px"></td>
                                            <td> <img src="{{ $row->mobile ? '/storage/' . $row->mobile : '/assets/images/noimage.jpeg' }}" class="img-thumbnail" width="100px"></td>
                                            <td>
                                                <form action="/dashboard/sliders/{{ $row->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    <p>Showing
                                        {{ $sliders->firstItem() }}
                                        To
                                        {{ $sliders->lastItem() }}
                                        Of
                                        {{ $sliders->total() }}
                                    </p>
                                </div>
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
</div>
@endsection