@extends('frontend.template')
@section('content')
    <?php
    function hitunghari($waktu_tenggat)
    {
        $date1 = date_create(date('Y-m-d', strtotime($waktu_tenggat))); //mis. tgl chekin
        $date2 = date_create(date('Y-m-d')); //mis. tgl chekout
        $diff = date_diff($date1, $date2); //menyimpan didalam fungsi date_diff
        return $diff->format('%d%'); //menampilkan jumlah hari
    }
    ?>
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-sm-10 text-center">
                        <h2 style="font-size: 28px; font-weight: bold">{{ $title_bar }}</h2>
                        {{-- <h3 class="text-warning my-3" style="font-size: 38px;">Rp <span id="terkumpul">0</span>
                        </h3>
                        <p class="text-white mb-0">Terkumpul dari Rp <span id="penggalangan">0</span></p> --}}
                        <p class="my-0 mt-5" style="font-size: 14px;">
                            <i class="fas fa-handshake fa-sm me-1"></i>
                            {{ $campaign->campaign_fund_items->where('transaction_status', 'Berhasil')->count() }} Donasi
                            <i class="fas fa-clock fa-sm ms-3 me-1"></i> {{ hitunghari($campaign->waktu_tenggat) }} Hari
                            <i class="fas fa-eye fa-sm ms-3 me-1"></i> @currency($campaign->views) Dilihat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Template --}}
    <div class="donation-details-area pt-4 pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="details-item">
                        <div class="details-img">
                            <div class="text-center">
                                <img src="/storage/{{ $campaign->image }}" alt="Details">
                            </div>
                            {!! $campaign->description !!}
                        </div>

                        {{-- <div class="card mt-5">
                            <div class="card-header text-uppercase"
                                style="font-weight: bold; background-color: #e5c600; color:white;">
                                <i class="fas fa-wallet me-2"></i>
                                Rincian Kebutuhan Dana
                            </div> --}}
                        <table class="table table-bordered small">
                            <thead>
                                <tr>
                                    <td colspan="2"
                                        style="font-weight: bold; background-color: #000000; color:white; font-size:18px;">
                                        <i class="fas fa-wallet me-2"></i>
                                        Rincian Kebutuhan Dana
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bg-light">Penggalangan</th>
                                    <td align="right"><span id="dana_galang">0</span></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Terkumpul</th>
                                    <td align="right"><span id="dana_terkumpul">0</span></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Disalurkan</th>
                                    <td align="right"><span id="dana_dicairkan">0</span></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tersisa</th>
                                    <td align="right"><span id="dana_sisa">0</span></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- </div> --}}

                        <div id="msg" class="text-center"></div>
                        <div class="card mt-5">
                            <div class="card-header text-uppercase"
                                style="font-weight: bold; background-color: #005331; color:white; font-size:18px;">
                                <i class="fas fa-wallet me-2"></i>
                                Donasi
                            </div>
                            <input type="hidden" name="campaign_id" id="campaign_id" value="{{ $campaign->id }}">
                            <div class="details-payment rounded shadow">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_anonim" value="false"
                                        id="is_anonim">
                                    <label class="form-check-label" for="is_anonim">
                                        Sembunyikan nama di donasi ini
                                    </label>
                                </div>
                                <div class="form-group mb-3 showName">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control mt-1 @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gross_amount">Isi nominal donasi</label>
                                    <input required type="text" name="gross_amount" id="gross_amount"
                                        onkeyup="strToNum('gross_amount')"
                                        class="form-control mt-1 @error('gross_amount') is-invalid @enderror">
                                    @error('gross_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Doa di donasi ini (opsional)</label>
                                    <textarea class="form-control mt-1 @error('description') is-invalid @enderror" name="description" id="description"
                                        rows="5"
                                        placeholder="Tulis doa untuk penggalang dana atau dirimu sendiri disini, agar doamu dilihat dan diamini oleh banyak orang ..."></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn common-btn topup"
                                    onclick="confirm('Yakin ingin melanjutkan?')">Donasi Sekarang</button>
                            </div>
                        </div>

                        <div class="card mt-5 mb-4">
                            <div class="card-header text-uppercase"
                                style="font-weight: bold; background-color: #005331; color:white; font-size:18px;">
                                <i class="fas fa-comments me-2"></i>
                                Doa-doa Orang Baik
                            </div>
                            <div class="card-body doadoa">
                            </div>
                            <div class="text-center mb-3 btnshowmore">
                                <button type="button" class="btn btn-outline-success btn-sm showmore">Lihat
                                    Semua</button>
                            </div>
                        </div>

                        <div class="mb-4 d-inline-block">
                            <p class="small mb-1">Bagikan ke:</p>
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>
                </div>
                @include('frontend.sidebarcampaigns')
            </div>
        </div>
    </div>
    {{-- End Template --}}
@endsection

@section('script')
    <script>
        $("#is_anonim").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
            } else {
                $(this).attr('value', 'false');
            }
        });

        formatStrNum('harga_beli');
        formatStrNum('gross_amount');

        loadDonations('{{ $campaign->id }}', 5, 0);

        var limit = 5;
        let offset = 0;
        $('.showmore').on('click', function() {
            limit += 5;
            loadDonations('{{ $campaign->id }}', limit, offset);
        });

        function loadDonations(campaign_id, limit, offset) {
            $('.doadoa').html('');
            $.ajax({
                url: '/api/campaigns/' + campaign_id + '/' + limit + '/' + offset,
                method: 'get',
                dataType: 'json',
                success: function(response) {

                    $('#terkumpul').html(formatRupiah(response.dana_terkumpul));
                    $('#penggalangan').html(formatRupiah(response.dana_galang));
                    $('#dana_galang').html(formatRupiah(response.dana_galang));
                    $('#dana_terkumpul').html(formatRupiah(response.dana_terkumpul));
                    $('#dana_dicairkan').html(response.dana_dicairkan ? formatRupiah(response.dana_dicairkan) :
                        '0');
                    $('#dana_sisa').html(formatRupiah(response.dana_sisa));

                    if (response.total > parseFloat(limit)) {
                        $('.btnshowmore').show();
                    } else {
                        $('.btnshowmore').hide();
                    }

                    for (let i = 0; i < response.results.length; i++) {
                        const item = response.results[i];
                        const name = item.is_anonim == 1 ? 'Orang Baik' : item.name;
                        const desc = item.description != null ? '<p>' + item.description + '</p>' : '';
                        const date = new Date(item.transaction_status_time);
                        const tanggal = date.toLocaleString('id-ID');
                        $('.doadoa').append(`
                        <figure class="mb-4 border-bottom">
                            <p style="font-weight: bold;" class="mb-1 mt-0" style="font-size: 16px;"><i
                                    class="fas fa-user fa-sm me-2"></i>` + name + `</p>
                            <blockquote class="blockquote" style="font-size: 16px;">
                            ` + desc + `
                            </blockquote>
                            <figcaption class="blockquote-footer" style="font-size: 12px;">
                                Berdonasi sebesar <cite title="donasi">Rp ` + formatRupiah(item.gross_amount) + `</cite> pada <cite
                                    title="tanggal">` + tanggal + `</cite>
                            </figcaption>
                        </figure>
                        `);
                    }
                }
            });
        }

        // PAYMENT GATEWAY
        $(document).on('click', '.topup', function() {
            const campaign_id = $('#campaign_id').val();
            const name = $('#name').val();
            const is_anonim = $('#is_anonim').val() == 'true' ? 1 : 0;
            const gross_amount = $('#gross_amount').val() ? $('#gross_amount').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            const description = $('#description').val();
            const transaction_type = 'Donasi';
            if (parseFloat(gross_amount) > 0) {
                $.ajax({
                    url: '/campaigns/donation',
                    method: 'post',
                    data: {
                        campaign_id,
                        name,
                        transaction_type,
                        gross_amount,
                        description,
                        is_anonim
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            snap.pay(response.data.snap_token, {
                                onSuccess: function(result) {
                                    updatefundItem(response.data.id, result);
                                    $('#msg').append(`
                                        <div class="alert small alert-success alert-dismissible fade show" role="alert">Terimakasih Anda Telah Berdonasi.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    `);
                                    loadDonations('{{ $campaign->id }}', 5, 0);
                                },
                                onPending: function(result) {
                                    updatefundItem(response.data.id, result);
                                    loadDonations('{{ $campaign->id }}', 5, 0);
                                },
                                onError: function(result) {
                                    updatefundItem(response.data.id, result);
                                    loadDonations('{{ $campaign->id }}', 5, 0);
                                }
                            });
                        }
                    }
                });
            } else {
                alert('Nominal donasi harus diisi.')
            }
        });

        function updatefundItem(id, result) {
            const transaction_status_time = result.transaction_time;
            const transaction_status = result.transaction_status;
            $.ajax({
                url: '/campaigns/donation/' + id,
                method: 'PUT',
                data: {
                    transaction_status_time,
                    transaction_status,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $('#name').val('');
                        $('#gross_amount').val('');
                        $('#description').val('');
                    } else {
                        $('#name').val('');
                        $('#gross_amount').val('');
                        $('#description').val('');
                    }
                }
            });
        }
    </script>
@endsection
