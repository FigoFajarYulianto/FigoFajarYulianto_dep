@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 text-uppercase">
                        {{ $title_bar }}
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>TANGGAL</th>
                                <th>NO.TRANSAKSI</th>
                                <th>PENGGUNA</th>
                                <th>KAMPANYE</th>
                                <th>TRANSAKSI</th>
                                <th>NOMINAL</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaignfunditems as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ date('d/m/Y H:i', strtotime($row->transaction_time)) }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="editStatus" data-id="{{ $row->id }}"
                                            data-idfund="{{ $row->id }}" data-wallet="campaign_fund"
                                            data-bs-toggle="modal" data-bs-target="#statusModal">
                                            {{ $row->no_transaksi }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $row->user->name }}
                                    </td>
                                    <td>
                                        {{ $row->campaign->title ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $row->transaction_type }} Kampanye
                                    </td>
                                    <td>
                                        @currency($row->gross_amount)
                                    </td>
                                    <td>
                                        {{ $row->transaction_status }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $campaignfunditems->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="wallet" id="wallet">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">No. Transaksi</label>
                                    <input type="text" class="form-control" name="no_trx" id="no_trx" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Transaksi</label>
                                    <input type="text" class="form-control" name="transaction_type" id="transaction_type"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Nominal</label>
                                    <input type="text" class="form-control" name="gross_amount" id="gross_amount"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Kampanye</label>
                                    <input type="text" class="form-control" name="campaign" id="campaign" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Deskripsi Penarikan</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Status</label>
                            <select name="transaction_status" id="transaction_status" class="form-control">
                                <option value="">:: Pilih ::</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Berhasil">Disetujui</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.editStatus').on('click ', function() {
            const id = $(this).data('id');
            const wallet = $(this).data('wallet');
            const idfund = $(this).data('idfund');
            $('input[name=_method]').val('PUT');
            $('#statusModalLabel').html('Perbarui Status');
            $('.modal form').prop('action', '/dashboard/campaignfundwithdrawals/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/campaignfundwithdrawals/' + idfund,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#wallet').val(wallet);
                    $('#name').val(response.user.name);
                    $('#campaign').val(response.campaign.title);
                    $('#no_trx').val(response.no_transaksi);
                    $('#transaction_type').val(response.transaction_type);
                    $('#description').val(response.description);
                    $('#gross_amount').val(response.gross_amount);
                    $('#transaction_status option[value=' + response.transaction_status + ']').prop(
                        'selected',
                        true);
                }
            });
        });
    </script>
@endsection
