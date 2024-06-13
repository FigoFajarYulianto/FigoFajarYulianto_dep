@extends('dashboard.template')
@section('content')
<h2 class="page-header-title">
    <div class="page-header-icon"><i data-feather="activity"></i></div>
    Item Orderan
</h2>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">Tambah Item Orderan
                        <a href="/dashboard/orderitems/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                    Pencarian :
                                    <div class="col-auto">
                                        <form action="/dashboard/menus" method="GET">
                                            <input type="search" id="" name="search" class="form-control">
                                        </form>
                                    </div>
                                </div>
                                <table class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Order Id</th>
                                            <th>Menu Id</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Keterangan</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderitems as $row)
                                        <tr>
                                            <td scope="row">{{ $orderitems->firstItem() + $loop->index }}</td>
                                            <td><a href="/dashboard/orderitems/{{ $row->id }}/edit">{{ $row->order_id }}</a>
                                            </td>
                                            <td>{{ $row->menu->nama ?? '' }}</td>
                                            <td>{{ $row->qty }}</td>
                                            <td>{{ $row->harga }}</td>
                                            <td>{{ $row->diskon }}</td>
                                            <td>{{ $row->keterangan }}</td>
                                            <td>
                                                <form action="/dashboard/orderitems/{{ $row->id }}" method="post">
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
                                        {{ $orderitems->firstItem() }}
                                        To
                                        {{ $orderitems->lastItem() }}
                                        Of
                                        {{ $orderitems->total() }}
                                    </p>
                                </div>
                                <div class="pull-right">
                                    {{ $orderitems->links() }}
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