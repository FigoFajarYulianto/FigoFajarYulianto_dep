@extends('dashboard.template')
@section('content')
    <?php
    $user = auth()->user();
    ?>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/dashboard/order" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Order</h4>
                    <form class="form-sample" action="/dashboard/order/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="faktur">Faktur</label>
                                    <input type="text" name="faktur" id="faktur"
                                        class="form-control mt-1 @error('faktur') is-invalid @enderror" value="">
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
                                    <input type="number" name="meja" id="meja"
                                        class="form-control mt-1 @error('meja') is-invalid @enderror" value="">
                                    @error('meja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama"
                                type="text" id="nama" value="" />
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="whatsapp">Whatsapp</label>
                            <input class="form-control mt-1 @error('whatsapp') is-invalid @enderror" name="whatsapp"
                                type="number" id="whatsapp" value="" />
                            @error('whatsapp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="total">Total</label>
                                    <input type="text" name="total" id="total"
                                        class="form-control  mt-1 @error('total') is-invalid @enderror" value="">
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="total_diskon">Total Diskon</label>
                                    <input type="text" name="total_diskon" id="total_diskon"
                                        class="form-control  mt-1 @error('total_diskon') is-invalid @enderror"
                                        value="">
                                    @error('total_diskon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="total_order">Total Order</label>
                                    <input type="text" name="total_order" id="total_order"
                                        class="form-control  mt-1 @error('total_order') is-invalid @enderror"
                                        value="">
                                    @error('total_order')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror " name="keterangan" id="keterangan"
                                rows="5"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="status_id">Status</label>
                            <div class="col-sm-12">
                                <select class="form-control mt-1 @error('status_id') is-invalid @enderror" name="status_id"
                                    id="status_id">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('status_id') == $item->id ? 'selected' : '' }}>
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
                        <div class="form-group mb-3 hide">
                            <label for="user_id">User Id</label>
                            <input class="form-control mt-1 @error('user_id') is-invalid @enderror" name="user_id"
                                type="number" id="user_id" />
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{--  <button type="submit" class="btn btn-primary mb-2">Simpan</button>  --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title">Order Per Item</p>
                    <div class="card-title">Edit
                        <a href="/dashboard/orders/create" class="ms-1"><i class="fa fa-plus-circle fa-lg"></i></a>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Order Id </th>
                                <th> Menu Id </th>
                                <th> Qty </th>
                                <th> Harga </th>
                                <th> Diskon </th>
                                <th> Harga </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderitem as $row)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td><a href="/dashboard/orderitems/{{ $row->id }}/edit">{{ $row->order_id }}</a>
                                    </td>
                                    <td>{{ $row->menu->nama ?? '' }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>{{ $row->harga }}</td>
                                    <td>{{ $row->diskon }}</td>
                                    <td>
                                        <form action="/dashboard/orderitems/{{ $row->id }}" method="post">
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
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="total">Total Qty</label>
                                <input type="text" name="total" id="total" class="form-control"
                                    onkeyup="strToNum('total')">
                                @error('total')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="total_diskon">Total Diskon</label>
                                <input type="text" name="total_diskon" id="total_diskon" class="form-control">
                                @error('total_diskon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="total_order">Total Harga</label>
                                <input type="text" name="total_order" id="total_order" class="form-control">
                                @error('total_order')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Hide -->
    <script>
        $('.hide').hide();
    </script>
    <!-- Penutip Hide -->
@endsection
