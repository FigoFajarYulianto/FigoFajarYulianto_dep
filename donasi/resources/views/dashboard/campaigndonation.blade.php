@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-uppercase">
                        <a href="/dashboard/campaigns" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Judul Kampanye</th>
                                <td align="right">{{ $campaign->title }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">TOTAL DONASI TERKUMPUL</th>
                                <td align="right">Rp. @currency($campaignfunditems->where('transaction_type', 'Donasi')->sum('gross_amount'))</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <p class="text-uppercase mb-2 mt-4" style="font-weight: bold">Riwayat Donatur</p>
                <div class="table-responsive">
                    <table class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>TANGGAL</th>
                                <th>NO.TRANSAKSI</th>
                                <th>NAMA</th>
                                <th>TRANSAKSI</th>
                                <th>NOMINAL</th>
                                <th>PESAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaignfunditems as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($row->transaction_time)) }}</td>
                                    <td>
                                        {{ $row->no_transaksi }}
                                    </td>
                                    <td>
                                        {{ $row->name ?? '' }}
                                    </td>
                                    <td>{{ $row->transaction_type }}</td>
                                    <td>@currency($row->gross_amount)</td>
                                    <td>{{ $row->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{-- {{ $fund_items->links() }} --}}
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
                url: '/dashboard/funditems/' + id,
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
