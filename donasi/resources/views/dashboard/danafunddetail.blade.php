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
                                <th class="bg-light">TOTAL DANA TERKUMPUL</th>
                                <td align="right">Rp. @currency($danafund->total_fund)</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <p class="text-uppercase mb-2 mt-4" style="font-weight: bold">Riwayat Muzakki</p>
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
                            @foreach ($danafunditems as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($row->transaction_time)) }}</td>
                                    <td>
                                        {{ $row->no_transaksi }}
                                    </td>
                                    <td>
                                        {{ $row->name }}
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
                    {{ $danafunditems->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
