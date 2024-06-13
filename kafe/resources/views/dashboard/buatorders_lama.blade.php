@extends('dashboard.template')
@section('content')
    <?php
    $user = auth()->user();
    ?>


    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/dashboard/orderitems" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Tambah Order Item</h4>
                    <form class="form-sample" action="/dashboard/orderitems/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="hide" for="order_id">Order_id</label>
                            <input type="number" name="order_id" id="order_id" class="hide"
                                value="{{ old('order_id', request('id')) }}">
                            @error('order_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="menu_id">Id Menu</label>
                                    <select class="form-control mt-1 @error('menu_id') is-invalid @enderror" name="menu_id"
                                        id="menu_id">
                                        <option value="">:: Pilih ::</option>
                                        @foreach ($menus as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('menu_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('menu_id')
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
                                    <label for="harga">Harga</label>
                                    <input class="form-control mt-1 @error('harga') is-invalid @enderror" name="harga"
                                        type="text" id="harga" value="{{ old('harga') }}" />
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="diskon">Diskon</label>
                                    <input class="form-control mt-1 @error('diskon') is-invalid @enderror" name="diskon"
                                        type="text" id="diskon" value="{{ old('diskon') }}" />
                                    @error('diskon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="qty">Qty</label>
                            <input class="form-control mt-1 @error('qty') is-invalid @enderror" name="qty"
                                type="text" id="qty" value="" />
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#menu_id').on('change', function() {
            if ($(this).val() == '') {
                $('#harga').val('');
                $('#diskon').val('');
            } else {
                $.ajax({
                    url: '/dashboard/menus/' + $(this).val(),
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {

                        if (response) {
                            $('#harga').val(response.harga);
                            $('#diskon').val(response.diskon);
                        } else {
                            $('#harga').val('');
                            $('#diskon').val('');
                        }
                    }
                });
            }
        })
    </script>

    <script>
        function getCart() {
            const carts = cartLS.list();
            $('#totalcart').html(carts.length);
            if (carts.length > 0) {
                $('#cartListOrder').html('');
                let grandtotal = 0;
                for (let i = 0; i < carts.length; i++) {
                    const cart = carts[i];
                    const subtotal = cart.price * cart.quantity;
                    grandtotal += subtotal;

                }

            }
        }
    </script>

    <script>
        $('.hide').hide();
    </script>
@endsection
