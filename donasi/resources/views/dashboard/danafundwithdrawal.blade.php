@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-uppercase">
                        <a href="/dashboard/datadanas" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="col-md-6">
                        <span class="ml-5 float-end">
                            @if ($danafund)
                                @if ($danafund->total_fund)
                                    <a href="/dashboard/danafundwithdrawals/{{ $dana->id }}/create"
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
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" align="center">{{ $dana->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">TOTAL DANA</th>
                                <td align="right">Rp. @currency($danafund->total_fund)</td>
                            </tr>
                            <tr>
                                <th class="bg-light">TOTAL PENARIKAN DANA</th>
                                <td align="right">Rp. @currency($danafund->penarikan_fund)</td>
                            </tr>
                            <tr>
                                <th class="bg-light">TOTAL SISA DANA</th>
                                <td align="right">Rp. @currency($danafund->sisa_fund ?? 0)</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <p class="text-uppercase mb-2 mt-4" style="font-weight: bold">Riwayat Pemberi Dana</p>
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
                                <th>PENERIMA DANA</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danafunditems->where('transaction_type', 'Transfer Out') as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($row->transaction_time)) }}</td>
                                    <td>
                                        @if ($row->transaction_status == 'Menunggu')
                                            <a href="/dashboard/danafundwithdrawals/{{ $row->id }}/edit">
                                                {{ $row->no_transaksi ?? '' }}
                                            </a>
                                        @else
                                            {{ $row->no_transaksi ?? '' }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $row->user->name }}
                                    </td>
                                    <td>{{ $row->transaction_type }}</td>
                                    <td>@currency($row->gross_amount)</td>
                                    <td>{{ $row->penerima_dana }}</td>
                                    <td>{{ $row->transaction_status }}</td>
                                    <td>
                                        <form action="/dashboard/danafundwithdrawals/{{ $row->id }}" method="post">
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
                    {{ $danafunditems->links() }}
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
