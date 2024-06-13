@extends('frontend.template')
@section('content')
    <style>
        .selengkapnya-btn {
            color: #fff;
            background-color: #005331;
            display: inline-block;
            padding: 5px 15px;
            font-weight: 600;
        }

        .selengkapnya-btn:hover {
            color: #fff;
            background-color: #ff6015;
            -webkit-transform: translate(0, -5px);
            transform: translate(0, -5px);
        }
    </style>
    <?php $sectionAbout = \App\Models\Section::getSection('about'); ?>
    @if ($sectionAbout && Request::is('/'))
        <div class="about-area pt-100 pb-70" data-aos="fade-up" data-aos-delay="100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="about-img">
                            <img src="/storage/{{ $about->image }}" alt="About">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-content">
                            <div class="section-title">
                                <span class="sub-title">Tentang Kami</span>
                                <h2>{{ $sectionAbout->name }}</h2>
                            </div>
                            {!! $about->description !!}
                            <div class="about-btn-area">
                                <a class="common-btn" href="{{ $about->link }}">Zakat/Infaq Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <?php
    function hitunghari($waktu_tenggat)
    {
        $date1 = date_create(date('Y-m-d', strtotime($waktu_tenggat))); //mis. tgl chekin
        $date2 = date_create(date('Y-m-d')); //mis. tgl chekout
        $diff = date_diff($date1, $date2); //menyimpan didalam fungsi date_diff
        return $diff->format('%d%'); //menampilkan jumlah hari
    }
    ?>
    <?php $sectionDonation = \App\Models\Section::getSection('donation'); ?>
    @if ($sectionDonation && Request::is('/') && $campaigns)
        <section class="donations-area three">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $sectionDonation->name }}</h2>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
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
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                {{ $persen }}%
                                            </div>
                                        </div>
                                        <ul class="my-2">
                                            <li class="small font-weight-bold">
                                                <h4>Rp @currency($item->nominal)</h4>
                                            </li>
                                            <li class="font-bold">{{ hitunghari($item->waktu_tenggat) }} Hari</li>
                                        </ul>
                                        <h4 style="font-size: 14px; font-style: italic;">Total
                                            {{ $item->campaign_fund_items->where('transaction_status', 'Berhasil')->count() }}
                                            donasi</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-md-6" style="text-align: right">
                        <a class="selengkapnya-btn" href="/campaigns">Selengkapnya</a>
                    </div>
                    <div class="col-md-6">
                        <a class="selengkapnya-btn" href="/auth">Open Donasi</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionCta = \App\Models\Section::getSection('call-to-action'); ?>
    @if ($sectionCta)
        <?php $cta = \App\Models\CallToAction::where('id', 1)->first(); ?>
        <section id="call-to-action" class="get-started"
            style="background-color: white; padding-top: 4rem; padding-bottom: 4rem;">
            <div class="container-fluid" data-aos="zoom-out">
                <div class="row text-white">
                    <div class="col gradient shadow p-0">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="cta-info w-100">
                                    <h4 class="display-4 fw-bold">{{ $cta->name }}</h4>
                                    {!! $cta->description !!}
                                    <button type="button" class="mt-3 rounded-pill btn-sm btn-rounded border-primary"
                                        onclick="goToUrl('{{ $cta->link }}')">{{ $sectionCta->name }}
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3" style="display: flex">
                                <img src="/storage/{{ $cta->image }}" alt="{{ $cta->name }}" style="margin: auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionLinks = \App\Models\Section::getSection('links'); ?>
    @if ($sectionLinks)
        <?php $links = \App\Models\Link::orderBy('id', 'ASC')->get(); ?>
        <section class="blog-area three scroll s-four" data-section-name="s-four">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $sectionLinks->name }}</h2>
                </div>
                <div class="row">
                    <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            @foreach ($links as $row)
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item">
                                            <a href="{{ $row->link }}" target="_blank">
                                                <img src="/storage/{{ $row->image }}" class="img-fluid"
                                                    alt="{{ $row->name }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionDonasi = \App\Models\Section::getSection('statistik-donasi'); ?>
    @if ($sectionDonasi && Request::is('/'))
        <section class="donations-area">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $sectionDonasi->name }}</h2>
                </div>
                <div class="row">
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['campaignfunditems_donatur'] }}"
                                                data-from-value="0" data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Donatur</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="donatur" class="donatur" style="font-size: 300%; color:#007243"></h1>
                        <label>Donatur</label> --}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['campaignfunds_total'] }}"
                                                data-from-value="0" data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Penghimpunan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="penghimpunancampaign" class="penghimpunancampaign"
                            style="font-size: 300%; color:#007243">
                        </h1>
                        <label>Penghimpunan</label> --}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['campaignfunds_penarikan'] }}"
                                                data-from-value="0" data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Penyaluran</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="penyalurancampaign" class="penyalurancampaign" style="font-size: 300%; color:#007243">
                        </h1>
                        <label>Penyaluran</label> --}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['campaign'] }}" data-from-value="0"
                                                data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Kampanye</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="campaign" class="campaign" style="font-size: 300%; color:#007243"></h1>
                        <label>Kampanye</label> --}}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionStatistik = \App\Models\Section::getSection('statistik-zakat'); ?>
    @if ($sectionStatistik && Request::is('/'))
        <section class="donations-area">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $sectionStatistik->name }}</h2>
                </div>
                <div class="row">
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['zakatfunditems_muzakki'] }}"
                                                data-from-value="0" data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Muzakki</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="muzakki" class="muzakki" style="font-size: 300%; color:#007243"></h1>
                        <label>Muzakki</label> --}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['zakatfunds_total'] }}" data-from-value="0"
                                                data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Penghimpunan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="penghimpunan" class="penghimpunan" style="font-size: 300%; color:#007243"></h1>
                        <label>Penghimpunan</label> --}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['zakatfunds_penarikan'] }}"
                                                data-from-value="0" data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Penyaluran</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="penyaluran" class="penyaluran" style="font-size: 300%; color:#007243"></h1>
                        <label>Penyaluran</label> --}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7">
                            <div class="elementor-element elementor-element-1f5dc5f angka-counter elementor-widget elementor-widget-counter"
                                data-id="1f5dc5f" data-element_type="widget" data-widget_type="counter.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-counter">
                                        <div class="elementor-counter-number-wrapper statistik">
                                            <span class="elementor-counter-number-prefix"></span>
                                            <h1 class="elementor-counter-number" data-duration="2000"
                                                data-to-value="{{ $statistik['zakatfunditems_mustahik'] }}"
                                                data-from-value="0" data-delimiter=",">0</h1>
                                            <span class="elementor-counter-number-suffix"></span>
                                        </div>
                                        <div class="elementor-counter-title">Mustahik</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h1 id="mustahik" class="mustahik" style="font-size: 300%; color:#007243"></h1>
                        <label>Mustahik</label> --}}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionLapor = \App\Models\Section::getSection('lapor-bencana'); ?>
    @if ($sectionLapor)
        <?php $lapor = \App\Models\Laporbencana::where('id', 1)->first(); ?>
        <section id="call-to-action" class="get-started"
            style="background-color: white; padding-top: 4rem; padding-bottom: 4rem;">
            <div class="container-fluid" data-aos="zoom-out">
                <div class="row text-white">
                    <div class="col gradientlapor shadow p-0">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="cta-info w-100">
                                    <h4 class="display-4 fw-bold">{{ $lapor->name }}</h4>
                                    {!! $lapor->description !!}
                                    <button type="button" class="mt-3 rounded-pill btn-sm btn-lapor border-lapor"
                                        onclick="goToUrl('{{ $lapor->link }}')">{{ $sectionLapor->name }}
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3" style="display: flex">
                                <img src="/storage/{{ $lapor->image }}" alt="{{ $lapor->name }}" style="margin: auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionPost = \App\Models\Section::getSection('posts'); ?>
    @if ($sectionPost && Request::is('/'))
        <?php $posts = \App\Models\Post::with(['postcategory', 'user'])
            ->where('status_id', 2)
            ->latest()
            ->simplePaginate(6); ?>
        <section class="blog-area three">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $sectionPost->name }}</h2>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    @foreach ($posts as $row)
                        <div class="col-sm-6 col-lg-4">
                            <div class="blog-item">
                                <div class="top">
                                    <a href="/posts/{{ $row->slug }}">
                                        <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}">
                                    </a>
                                </div>
                                <div class="bottom">
                                    <ul>
                                        <li>
                                            <i class="icofont-calendar"></i>
                                            <span>{{ date('d/m/Y', strtotime($row->created_at)) }}</span>
                                        </li>
                                        <li>
                                            <i class="icofont-user-alt-3"></i>
                                            <a href="/posts?author={{ $row->user->username }}">{{ $row->user->name }}</a>
                                        </li>
                                    </ul>
                                    <h3>
                                        <a href="/posts/{{ $row->slug }}">{{ $row->title }}</a>
                                    </h3>
                                    <p>{{ Str::substr(strip_tags($row->body), 0, 98) }}</p>
                                    <a class="blog-btn" href="/posts/{{ $row->slug }}">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
    <script>
        function goToUrl(url) {
            window.location = url;
        }
    </script>
    {{-- <script>
        function singkat_angka(n, presisi = 1) {

            if (n < 900) {
                let format_angka = number_format(n, presisi);
                let simbol = '';

                let pisah = '.'.repeat('0', +presisi);
                let angka = pisah.replace('', format_angka);

                return angka + simbol;

            } else if (n < 900000) {
                let format_angka = number_format(n / 1000, presisi);
                let simbol = ' Ribu';

                let pisah = '.'.repeat('0', +presisi);
                let angka = pisah.replace('', format_angka);

                return angka + simbol;

            } else if (n < 900000000) {
                let format_angka = number_format(n / 1000000, presisi);
                let simbol = ' Juta';

                return format_angka + simbol;

            } else if (n < 900000000000) {
                let format_angka = number_format(n / 1000000000, presisi);
                let simbol = ' Milyar';

                let pisah = '.'.repeat('0', +presisi);
                let angka = pisah.replace('', format_angka);

                return angka + simbol;

            } else {
                let format_angka = number_format(n / 1000000000000, presisi);
                let simbol = ' Triliun';

                let pisah = '.'.repeat('0', +presisi);
                let angka = pisah.replace('', format_angka);

                return angka + simbol;

            }

        }

        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
            var s = ''

            var toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec)
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || ''
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

        //penggunaan fungsi singkat angka
        // console.log(singkat_angka(880000000));

        // load
        $.ajax({
            url: '/api/zakats',
            method: 'get',
            dataType: 'json',
            success: function(response) {
                $('#muzakki').html(response.zakattransactionitems_muzakki);
                $('#mustahik').html(response.zakattransactionitems_mustahik);
                $('#penghimpunan').html(singkat_angka(response.zakatfunds_total));
                $('#penyaluran').html(singkat_angka(response.zakatfunds_penarikan));
            }
        });

        $.ajax({
            url: '/api/campaigns',
            method: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#donatur').html(response.campaignfunditems_donatur);
                $('#campaign').html(response.campaignfunditems_penarikan);
                $('#penghimpunancampaign').html(singkat_angka(response.campaignfunds_total));
                $('#penyalurancampaign').html(singkat_angka(response.campaignfunds_penarikan));
            }
        });
    </script> --}}
@endsection
