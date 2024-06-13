@extends('dashboard.template')
@section('content')
<h2 class="page-header-title">
    <div class="page-header-icon"><i data-feather="activity"></i></div>
    Orderan Pelanggan
</h2>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    {{-- <div class="card-title">Tambah Orderan Pelanggan
                            <a href="/dashboard/orders/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                        </div>  --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                    Pencarian :
                                    <div class="col-auto">
                                        <form action="/dashboard/orders" method="GET">
                                            <input type="search" id="" name="search" class="form-control">
                                        </form>
                                    </div>
                                </div>
                                <table class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Meja</th>
                                            <th>Faktur</th>
                                            <th>Total</th>
                                            <th>Total Diskon</th>
                                            <th>Grand Total</th>
                                            <th>Status</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $grandTotal = 0;
                                        $grandTotalDiskon = 0;
                                        $grandTotalOrder = 0;
                                        ?>
                                        @foreach ($orders as $row)
                                        <?php
                                        $grandTotal += $row->total;
                                        $grandTotalDiskon += $row->total_diskon;
                                        $grandTotalOrder += $row->total_order;
                                        ?>
                                        <tr>
                                            <td>{{ $orders->firstItem() + $loop->index }}</td>
                                            <td><a href="/dashboard/orders/{{ $row->id }}/edit">{{ $row->nama }}</a>
                                            </td>
                                            <td>{{ $row->meja }}</td>
                                            <td>{{ $row->faktur }}</td>
                                            <td>{{ $row->total }}</td>
                                            <td>{{ $row->total_diskon }}</td>
                                            <td>{{ $row->total_order }}</td>
                                            <td>{{ $row->status->nama ?? '' }}</td>
                                            <td>
                                                <form action="/dashboard/orders/{{ $row->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-light" style="font-weight: bold;">
                                            <td colspan="4">GRAND TOTAL</td>
                                            <td>@currency($grandTotal)</td>
                                            <td>@currency($grandTotalDiskon)</td>
                                            <td>@currency($grandTotalOrder)</td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div>

                                    <p>Showing
                                        {{ $orders->firstItem() }}
                                        To
                                        {{ $orders->lastItem() }}
                                        Of
                                        {{ $orders->total() }}
                                    </p>

                                </div>
                                <div class="pull-right">
                                    {{ $orders->links() }}
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