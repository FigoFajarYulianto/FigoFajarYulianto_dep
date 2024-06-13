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
                    <div class="col-lg-10 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $title_bar }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="donations-area three pt-5 pb-5 mb-5">
        <div class="container">
            <div class="row">
                @foreach ($campaigns as $item)
                    <div class="col-sm-6 col-lg-4">
                        <div class="donation-item">
                            <div class="top">
                                <a class="tags"
                                    href="/campaigns?category={{ $item->category->slug }}">{{ $item->category->name }}</a>
                                <h3>
                                    <a href="/campaigns/{{ $item->slug }}">{{ $item->title }}</a>
                                </h3>
                                <p>{!! substr($item->description, 0, 100) !!} ...</p>
                            </div>
                            <div class="img">
                                <img src="/storage/{{ $item->image }}" alt="Donation">
                                <a class="common-btn" href="/campaigns/{{ $item->slug }}">Donasi</a>
                            </div>
                            <div class="inner">
                                <div class="bottom">
                                    <?php
                                    $campaign_fund = $item->campaign_fund->total_fund ?? 0;
                                    $persen = ($campaign_fund / $item->nominal) * 100;
                                    ?>
                                    <div class="progress my-3">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $persen }}%; background-color: #ff6015;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $persen }}%
                                        </div>
                                    </div>
                                    <ul class="my-2">
                                        <li class="small font-weight-bold">
                                            <h4>Rp @currency($item->nominal)</h4>
                                        </li>
                                        <li class="font-bold">{{ hitunghari($item->waktu_tenggat) }} Hari</li>
                                    </ul>
                                    <h4 style="font-size: 14px; font-style: italic;">Total {{ $item->campaign_fund_items->count() }} donasi</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $campaigns->links() }}
        </div>
    </section>
@endsection
