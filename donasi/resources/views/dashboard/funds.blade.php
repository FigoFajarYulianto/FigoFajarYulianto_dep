@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-uppercase">
                        {{ $title_bar }}
                    </div>
                    <div class="col-md-6">
                        <span class="ml-5 float-end">
                            <a href="/dashboard/fundtopups/create" class="ms-2 btn btn-success btn-sm">Isi Saldo</a>
                            @if ($fund)
                                @if ($fund->total_fund)
                                    <a href="/dashboard/fundwithdrawals/create"
                                        class="ms-2 btn btn-warning btn-sm">Penarikan</a>
                                @endif
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="row">
                    <div class="col-md-5">
                        <table class="table table-bordered">
                            <tr>
                                <th class="bg-light">TOTAL KANTONG DONASI</th>
                                <td align="right">Rp. @currency($fund->total_fund ?? 0)</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <p class="text-uppercase mb-2 mt-4" style="font-weight: bold">Riwayat Kantong Donasi</p>
                <div class="table-responsive">
                    <table class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>TANGGAL</th>
                                <th>NO.TRANSAKSI</th>
                                <th>NAMA</th>
                                <th>TRANSAKSI</th>
                                <th>BANK</th>
                                <th>KAMPANYE</th>
                                <th>NOMINAL</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fund_items as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($row->transaction_time)) }}</td>
                                    <td>
                                        @if ($row->transaction_status == 'Menunggu')
                                            <a href="/dashboard/fundwithdrawals/{{ $row->id }}/edit">
                                                {{ $row->transaction_type == 'Donasi' ? 'DN' : ($row->transaction_type == 'Penarikan' ? 'PN' : 'TP') }}/{{ $row->order_id }}
                                            </a>
                                        @else
                                            {{ $row->transaction_type == 'Donasi' ? 'DN' : ($row->transaction_type == 'Penarikan' ? 'PN' : 'TP') }}/{{ $row->order_id }}
                                        @endif
                                    </td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->transaction_type }}</td>
                                    <td>{{ $row->bank->bank ?? '-' }}</td>
                                    <td>
                                        @if ($row->campaign)
                                            <a target="_blank"
                                                href="/campaigns/{{ $row->campaign->slug }}">{{ $row->campaign->title }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        {{ $row->transaction_type != 'Topup' ? '-' : '+' }}@currency($row->gross_amount)
                                    </td>
                                    <td>
                                        @if ($row->transaction_status == 'Menunggu' && $row->transaction_type != 'Penarikan')
                                            <a href="#" id="pay-button" data-snaptoken='{{ $row->snap_token }}'
                                                data-id='{{ $row->id }}'>{{ $row->transaction_status }}</a>
                                        @else
                                            {{ $row->transaction_status }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/dashboard/funds/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                {{ $row->transaction_status == 'Menunggu' ? '' : 'Disabled' }}><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $fund_items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '#pay-button', function() {
            const snaptoken = $(this).data('snaptoken');
            const id = $(this).data('id');
            snap.pay(snaptoken, {
                // Optional
                onSuccess: function(result) {
                    updatefundItem(id, result);
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    updatefundItem(id, result);
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    updatefundItem(id, result);
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        })

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
