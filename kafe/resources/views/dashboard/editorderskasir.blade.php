@extends('dashboard.template')
@section('content')
<?php
$user = auth()->user();
?>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="coffee"></i></div>
                                Edit Order Kasir
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="mb-5 container-fluid px-4">
            <div class="card">
                <div class="card-body">
                    <a href="/dashboard/orders" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Order</h4>
                    <form class="form-sample" action="/dashboard/kasir/orders/{{ $order->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="faktur">Faktur</label>
                                    <input type="text" name="faktur" id="faktur" class="form-control mt-1 @error('faktur') is-invalid @enderror" value="{{ old('faktur', $order->faktur) }}" readonly="readonly">
                                    @error('faktur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="meja">Nomer Meja</label>
                                    <input type="number" name="meja" id="meja" class="form-control mt-1 @error('meja') is-invalid @enderror" value="{{ old('meja', $order->meja) }}" readonly="readonly">
                                    @error('meja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama" type="text" id="nama" value="{{ old('nama', $order->nama) }}" readonly="readonly" />
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input class="form-control mt-1 @error('whatsapp') is-invalid @enderror" name="whatsapp" type="number" id="whatsapp" value="{{ old('whatsapp', $order->whatsapp) }}" readonly="readonly" />
                                    @error('whatsapp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input class="hide form-control mt-1 @error('user_id') is-invalid @enderror" name="user_id" type="number" id="user_id" value="{{ old('user_id', $user->id) }}" readonly />

                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-title">Order Per Item</p>
                        <div class="card-title">Tambah Order
                            <a href="/dashboard/orderitems/create?id={{ $order->id }}" class="ms-1"><i class="fa fa-plus-circle fa-lg"></i></a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="customTable" class="table table-bordered small" style="width:100%">
                            <thead class="text-uppercase bg-light">
                                <tr>
                                    <th> # </th>
                                    <th> Order Id </th>
                                    <th> Menu Id </th>
                                    <th> Qty </th>
                                    <th> Harga </th>
                                    <th> Hapus </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderitem as $row)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td> <a href="javascript:void(0)" class="editorderitems" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#orderitemsModal">
                                            {{ $row->order_id }}
                                        </a>
                                    </td>
                                    <td>{{ $row->menu->nama ?? '' }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>@currency($row->harga)</td>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror " name="keterangan" id="keterangan" rows="1" readonly="readonly">{{ old('keterangan', $order->keterangan) }}</textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="total_bayar">Total Harga</label>
                                <input type="text" name="total_bayar" id="total_bayar" class="form-control" value="@currency(old('total_bayar', $order->total))" onkeyup="strToNum('total_bayar')" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <form class="form-sample" action="/dashboard/kasir/orders/{{ $order->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="status_id">Status</label>
                            <div class="col-sm-12">
                                <select class="form-control mt-1 @error('status_id') is-invalid @enderror" name="status_id" id="status_id">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($statusorder as $item)
                                    <option value="{{ $item->id }}" {{ old('status_id', $order->status_id ?? '') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <input class="hide form-control mt-1 @error('user_id') is-invalid @enderror" name="user_id" type="number" id="user_id" value="{{ old('user_id', $user->id) }}" readonly />

                        <center>
                            <button type="submit" class="btn btn-primary mt-3 mb-2">Simpan</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection
@section('script')
<script>
    $('.hide').hide();
</script>
@endsection