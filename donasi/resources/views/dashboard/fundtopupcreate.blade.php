@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/funds" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <div class="form-group mb-3">
                            <label for="user_id">Nama</label>
                            <input type="hidden" name="user_id" id="user_id"
                                value="{{ old('user_id', auth()->user()->id) }}" />
                            <input class="form-control mt-1" type="text"
                                value="{{ old('user_id', auth()->user()->name) }}" readonly />
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="transaction_type">Jenis Transaksi</label>
                                    <input type="text" class="form-control" name="transaction_type" id="transaction_type"
                                        value="Topup" readonly>
                                    @error('transaction_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="gross_amount">Nominal</label>
                                    <input class="form-control @error('gross_amount') is-invalid @enderror"
                                        name="gross_amount" type="text" id="gross_amount"
                                        value="{{ old('gross_amount') }}" onkeyup="strToNum('gross_amount')" />
                                    @error('gross_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 mt-3 topup">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        formatStrNum('gross_amount');

        $(document).on('click', '.topup', function() {
            const user_id = $('#user_id').val();
            const transaction_type = $('#transaction_type').val();
            const gross_amount = $('#gross_amount').val() ? $('#gross_amount').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            $.ajax({
                url: '/dashboard/fundtopups',
                method: 'post',
                data: {
                    user_id,
                    transaction_type,
                    gross_amount,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        snap.pay(response.data.snap_token, {
                            // Optional
                            onSuccess: function(result) {
                                updatefundItem(response.data.id, result);
                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                console.log(result)
                            },
                            // Optional
                            onPending: function(result) {
                                updatefundItem(response.data.id, result);
                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                console.log(result)
                            },
                            // Optional
                            onError: function(result) {
                                updatefundItem(response.data.id, result);
                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                console.log(result)
                            }
                        });
                    }
                }
            });
        });

        function updatefundItem(id, result) {
            const transaction_status_time = result.transaction_time;
            const transaction_status = result.transaction_status;
            $.ajax({
                url: '/dashboard/fundtopups/' + id,
                method: 'PUT',
                data: {
                    transaction_status_time,
                    transaction_status,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        console.log('berhasil');
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html(response.msg);
                        location.reload();
                    } else {
                        console.log('gagal');
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html(response.msg);
                    }
                }
            });
        }
    </script>
@endsection
