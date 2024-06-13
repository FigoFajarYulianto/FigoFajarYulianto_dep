@extends('frontend.template')
@section('content')
    <?php $sectionSlider = \App\Models\Section::getSection('sliders'); ?>
    @if ($sectionSlider && Request::is('/'))
        <?php $sliders = \App\Models\Slider::orderBy('id', 'DESC')->get(); ?>
        <div class="slider" style="margin-top: -1px;">
            <div id="slide-home" class="owl-carousel owl-theme mobil-hidden" data-aos="fade-in">
                @foreach ($sliders as $row)
                    <div class="item">
                        <img src="/storage/{{ $row->desktop }}" alt="{{ $row->name }}">
                    </div>
                @endforeach
            </div>
            <div id="slide-home1" class="owl-carousel owl-theme only-mobile" data-aos="fade-in">
                @foreach ($sliders as $row)
                    <div class="item">
                        <img src="/storage/{{ $row->mobile }}" alt="{{ $row->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <?php $sectionAbout = \App\Models\Section::getSection('about'); ?>
    @if ($sectionAbout && Request::is('/'))
        <section class="about scroll s-one" data-section-name="s-one">
            <div class="about-area pt-100 pb-70">
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
                                    <h2>{{ $about->name }}</h2>
                                </div>
                                {!! $about->description !!}
                                <div class="about-btn-area">
                                    <a class="common-btn" href="{{ $about->link }}">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <?php $sectionService = \App\Models\Section::getSection('services'); ?>
    @if ($sectionService)
        <?php $services = \App\Models\Service::orderBy('id', 'DESC')->get(); ?>
        <section class="blog-area three pt-100 pb-70 scroll s-two" data-section-name="s-two"
            style="background-color: #f9f9f9">
            <div class="container">
                <div class="section-title">
                    <div class="row">
                        <h2>Layanan <img src="/assets/img/J-BANGGA.png" style="width: 200px" alt=""></h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($services as $row)
                        <div class="bg-image col-6 col-sm-6 col-lg-2 my-4">
                            <div class="blog-item">
                                <a href="/services/{{ $row->slug }}">
                                    <img src="/storage/{{ $row->image }}" class="w-100 rounded-top" />
                                    <div class="mask text-light d-flex justify-content-center flex-column text-center">
                                        <a href="/services/{{ $row->slug }}"
                                            style="color: black">{{ $row->name }}</a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <?php $sectionCta = \App\Models\Section::getSection('call-to-action'); ?>
    @if ($sectionCta)
        <?php $cta = \App\Models\CallToAction::where('id', 1)->first(); ?>
        <section id="call-to-action" class="call-to-action scroll s-three" data-section-name="s-three"
            style="background: linear-gradient(rgba(14, 29, 52, 0.6), rgba(14, 29, 52, 0.8)), url('/storage/{{ $cta->image }}') center center;">
            <div class="container" data-aos="zoom-out">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h3>{{ $cta->name }}</h3>
                        <div class="text-white">{!! $cta->description !!}</div>
                        <a class="cta-btn mt-4" href="{{ $cta->link }}">{{ $sectionCta->name }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <?php $sectionLinks = \App\Models\Section::getSection('links'); ?>
    @if ($sectionLinks)
        <?php $links = \App\Models\Link::orderBy('id', 'ASC')->get(); ?>
        <section class="blog-area three pt-100 pb-70 scroll s-four" data-section-name="s-four">
            <div class="container">
                <div class="section-title">
                    <h2><?= $sectionLinks->name ?></h2>
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

    <?php $sectionTesti = \App\Models\Section::getSection('testimonials'); ?>
    @if ($sectionTesti)
        <?php $testimonials = \App\Models\Testimonial::orderBy('id', 'ASC')->get(); ?>
        <section id="testimonials" class="testimonials scroll s-five" data-section-name="s-five">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2500 200">
                {{-- <path fill="#fff" fill-opacity="1"
                    d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path> --}}
            </svg>
            <div class="container">
                <div class="row text-center text-white">
                    <h1 class="fw-bold" style="font-size: 24px;">{{ $sectionTesti->name }}</h1>
                    <hr style="width: 100px; height: 3px; " class="mx-auto">
                    <p class="lead pt-1"></p>
                </div>

                <div class="row align-items-center">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($testimonials as $key => $row)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <div class="testimonials__card">
                                        <p class="lh-lg">
                                            <i class="fas fa-quote-left"></i>
                                            {{ $row->description }}
                                            <i class="fas fa-quote-right"></i>
                                            <input disabled id="rateStar" name="rateStar"
                                                class="ratings p-0 rating rating-loading" data-show-clear="false"
                                                data-show-caption="false" data-size="xs" value="{{ $row->star }}">
                                        </p>
                                    </div>
                                    <div class="testimonials__picture">
                                        <img src="/storage/{{ $row->image }}" alt="{{ $row->name }}"
                                            class="rounded-circle img-fluid">
                                    </div>
                                    <div class="testimonials__name">
                                        <h3>{{ $row->name }}</h3>
                                        <p class="fw-light">{{ $row->title }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button class="btn btn-outline-light fas fa-long-arrow-alt-left" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            </button>
                            <button class="btn btn-outline-light fas fa-long-arrow-alt-right" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            </button>
                        </div>
                        <div class="selengkapnyasurvey text-center mt-3">
                            <a class="donate-btn btn-sm" href="">
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1"
                    d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </section>
    @endif

    <?php $sectionPost = \App\Models\Section::getSection('posts'); ?>
    @if ($sectionPost && Request::is('/'))
        <?php $posts = \App\Models\Post::with(['postcategory', 'user'])
            ->where('status', 1)
            ->latest()
            ->simplePaginate(6); ?>
        <section class="blog-area three pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h2>Berita Terbaru</h2>
                </div>
                <div class="row">
                    <div class="slides-6 swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            @foreach ($posts as $row)
                                <div class="swiper-slide">
                                    <div class="blog-item" style="margin: 10px">
                                        <div class="top">
                                            <a href="/posts/{{ $row->slug }}">
                                                <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}">
                                            </a>
                                        </div>
                                        <div class="bottom">
                                            <ul>
                                                <li>
                                                    <i class="icofont-calendar"></i>
                                                    <span
                                                        style="font-size: 12px;">{{ date('d/m/Y', strtotime($row->created_at)) }}</span>
                                                </li>
                                            </ul>
                                            <h3 style="font-size: 12px;">
                                                <a href="/posts/{{ $row->slug }}">{{ $row->title }}</a>
                                            </h3>
                                            {{-- <p style="font-size: 12px;">{{ Str::substr(strip_tags($row->body), 0, 98) }}
                                            </p>
                                            <a class="blog-btn" href="/posts/{{ $row->slug }}"
                                                style="font-size: 12px;">Selengkapnya</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br><br>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <?php $sectionPPID = \App\Models\Section::getSection('ppid'); ?>
    @if ($sectionPPID)
        <?php $ppid = \App\Http\Helpers\ApiPPID::getNews(); ?>
        <section class="blog-area three pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h2>Berita Terbaru</h2>
                </div>
                <div class="row">
                    <div class="slides-6 swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            @foreach ($ppid as $row)
                                <div class="swiper-slide">
                                    <div class="blog-item" style="margin: 10px">
                                        <div class="top">
                                            <a href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">
                                                <img src="https://ppid.jemberkab.go.id/{{ str_replace('public/', 'storage/', $row['foto_berita']) }}"
                                                    alt="{{ $row['judul_berita'] }}">
                                            </a>
                                        </div>
                                        <div class="bottom">
                                            <ul>
                                                <li>
                                                    <i class="icofont-calendar"></i>
                                                    <span
                                                        style="font-size: 12px;">{{ date('d/m/Y', strtotime($row['created_at'])) }}</span>
                                                </li>
                                            </ul>
                                            <h3 style="font-size: 12px;">
                                                <a
                                                    href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">{{ $row['judul_berita'] }}</a>
                                            </h3>
                                            {{-- <p style="font-size: 12px;">
                                                {{ Str::substr(strip_tags($row['isi_berita']), 0, 98) }}
                                            </p>
                                            <a class="blog-btn"
                                                href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">Selengkapnya</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br><br>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            screenCheck();
        });

        $(window).on('resize', function() {
            screenCheck();
        });

        function applyScroll() {
            $.scrollify({
                section: '.scroll',
                sectionName: 'section-name',
                //standardScrollElements: 'section',
                easing: 'easeOutExpo',
                scrollSpeed: 100,
                offset: 0,
                scrollbars: true,
                setHeights: true,
                overflowScroll: true,
                updateHash: false,
                touchScroll: true,
            });
        }

        function screenCheck() {
            var deviceAgent = navigator.userAgent.toLowerCase();
            var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
            if (agentID || $(window).width() <= 1024) {
                // its mobile screen
                $.scrollify.destroy();
                $('section').removeClass('scroll').removeAttr('style');
                $.scrollify.disable();
            } else {
                // its desktop
                $('section').addClass('scroll');
                applyScroll();
                $.scrollify.enable();
            }
        }
    </script>
@endsection
