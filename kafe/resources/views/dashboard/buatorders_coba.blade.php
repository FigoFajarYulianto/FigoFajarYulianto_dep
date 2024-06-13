@extends('dashboard.template')
@section('content')

<?php
$user = auth()->user();
?>

<style>
    .number-order {
        left: 280px;
    }

    .left-list {
        position: relative;
        left: 330px;
        margin-right: 800px;
    }

    .form-control-search {
        display: block;
        width: 100%;
        padding: 0.875rem 1.125rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1;
        color: #69707a;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #c5ccd6;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.35rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    @media only screen and (max-width: 1024px) {
        .left-list {
            position: relative;
            left: 10px;
            margin-right: 800px;
        }

        .number-order {
            left: 160px;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Data User
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">
                    <a href="/dashboard/orders/{{(request('id'))}}/edit" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Tambah Order Item</h4>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="heading-tabs">
                                        <div class="row">
                                            <div class="col-lg-6 offset-lg-3">
                                                <ul>
                                                    <form action="{{ route('search') }}" method="GET">
                                                        <select class="form-control-search mt-1 @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                                            <option value="">:: Pilih ::</option>
                                                            <?php $categotys = \App\Models\Category::orderBy('nama', 'ASC')->get(); ?>
                                                            @foreach ($categotys as $item)
                                                            <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <input style="background-color:#ff6600; color:white; margin-top:20px;" type="submit" value="Cari" class="btn">
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <section class='tabs-content'>
                                        <article>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="left-list" id="menus" data-totalmenu="{{ $menus->count() }}">
                                                            @foreach ($menus as $i => $row)
                                                            <div class="col-lg-12">
                                                                <div class="tab-item">
                                                                    <img style="float: left; width: 100px; max-width: 100px; margin-right: 20px; border-radius: 5px;" src="/storage/{{ $row->photo }}" alt="">
                                                                    <h4 class="my-0 pt-0">{{ $row->nama }}</h4>
                                                                    <span class="small my-0"><i class="fas fa-tags fa-sm text-muted mr-1"></i>
                                                                        {{ $row->category->nama }}</span>
                                                                    <p class="my-0">
                                                                        <strong>Rp @currency($row->harga)</strong> &nbsp;
                                                                        @if ($row->diskon)
                                                                        <span class="small"><del>Rp
                                                                                @currency($row->diskon)</del></span>
                                                                        @endif
                                                                    </p>
                                                                    <div class="number-order input-group">
                                                                        <span class="input-group-btn">
                                                                            <input type="button" class="btn-number button-minus" data-type="minus" data-field="qty{{ $i }}" value="-">
                                                                        </span>
                                                                        <input style="position: relative; height: 30px; left: -6px; text-align: center; width: 60px; display: inline-block; font-size: 13px; margin: 0 0 5px; resize: vertical;" type="number" name="qty{{ $i }}" id="qty{{ $i }}" class="input-number" value="0" min="0" data-id="{{ $row->id }}" data-menu="{{ $row->nama }}" data-harga="{{ $row->harga }}">
                                                                        <span class="input-group-btn">
                                                                            <input type="button" class="btn-number button-plus" data-type="plus" data-field="qty{{ $i }}" value="+">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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