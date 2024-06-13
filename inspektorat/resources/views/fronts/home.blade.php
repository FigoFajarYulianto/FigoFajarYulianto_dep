@extends('fronts.template')
@section('content')
    <style>
        .testimonial {
            position: relative;
            padding: 0;
            background: linear-gradient(to right, rgba(14, 29, 52, 0.9), rgba(14, 29, 52, 0.9));
        }

        .testimonial__card {

            padding: 2rem 1.25rem;
            border-radius: 0.625rem;
            height: auto;
            text-align: center;
        }

        .testimonial__card i {
            font-size: 1.5rem;
            color: rgba(153, 38, 240, 0.7);
        }

        .testimonial__card .ratings i {
            color: rgba(153, 38, 240, 0.7);
            font-size: 1rem;
        }

        .testimonial__picture {
            width: 6rem;
            height: 6rem;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .testimonial__picture img {
            border: 0.325rem solid rgba(153, 38, 240, 0.7);
        }

        .testimonial__name {
            padding-top: 3rem;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 500;
            color: #fff;
        }

        .testimonial__name h3 {
            padding-top: 0.8rem;
            text-transform: capitalize;
        }

        .testimonial__name p {
            padding-bottom: 2rem;
            text-transform: capitalize;
        }
    </style>

    <?php $sectionAbout = \App\Models\Section::getSection('about'); ?>
    @if ($sectionAbout && Request::is('/'))
        <section id="about" class="about pt-0">
            <div class="container">
                <div class="section-header"><span>Tentang Kami</span>
                    <h2>Tentang Kami</h2>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-4 content order-last order-lg-first">
                        <img src="/storage/{{ $about->image }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 position-relative align-self-start order-lg-last order-first">
                        {!! $about->description !!}
                        <div class="about-btn-area">
                            <a class="common-btn" style="background-color: rgba(14, 29, 52, 0.9)"
                                href="{{ $about->link }}">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Layanan Kami -->
    <?php $sectionService = \App\Models\Section::getSection('services'); ?>
    @if ($sectionService)
        <?php $sevices = \App\Models\Service::orderBy('id', 'DESC')->get(); ?>
        <section class="team-area four pt-100 pb-70" id="layanan">
            <div class="container">
                <div class="section-header"><span><?= $sectionService->name ?></span>
                    <h2><?= $sectionService->name ?></h2>
                </div>
                <div class="row">
                    @foreach ($sevices as $row)
                        <div class="col-sm-6 col-lg-3">
                            <div class="team-item">
                                <div class="top">
                                    <a href="{{ $row->link }}">
                                        <img class="img-fluid" src="/storage/{{ $row->image }}" alt="{{ $row->name }}">
                                    </a>
                                </div>
                                <div class="bottom">
                                    <h5><a style="color: black;" href="{{ $row->link }}">{{ $row->name }}</a></h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--End Layanan Kami -->

    <!-- Call To Action -->
    <?php $sectionCta = \App\Models\Section::getSection('call-to-action'); ?>
    @if ($sectionCta)
        <?php $cta = \App\Models\CallToAction::where('id', 1)->first(); ?>
        <section id="call-to-action" class="call-to-action"
            style="background: linear-gradient(rgba(14, 29, 52, 0.6), rgba(14, 29, 52, 0.8)), url('/storage/{{ $cta->image }}') center center;">
            <div class="container">
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
    <!--End Call To Action -->

    <!-- Link Terkait -->
    <?php $sectionLinks = \App\Models\Section::getSection('links'); ?>
    @if ($sectionLinks)
        <?php $links = \App\Models\Link::orderBy('id', 'ASC')->get(); ?>
        <section id="links" class="testimonials">
            <div class="container">
                <div class="section-header"><span><?= $sectionLinks->name ?></span>
                    <h2><?= $sectionLinks->name ?></h2>
                </div>
                <div class="slides-3 swiper">
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
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Link Terkait -->

    <!-- Testimonial -->
    <?php $sectionTesti = \App\Models\Section::getSection('testimonials'); ?>
    @if ($sectionTesti)
        <?php $testimonials = \App\Models\Testimonial::orderBy('id', 'ASC')->get(); ?>
        <div class="section-header"><span><?= $sectionTesti->name ?></span>
            <h2><?= $sectionTesti->name ?></h2>
        </div>
        <section id="testimonials" class="testimonial">

            <div class="container">
                <div class="row text-center text-white">

                    <hr style="width: 100px; height: 3px; " class="mx-auto">
                    <p class="lead pt-1"></p>
                </div>

                <div class="row align-items-center">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($testimonials as $key => $row)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <div class="testimonial__card">
                                        <p class="lh-lg" style="color:white;">
                                            <i class="fas fa-quote-left" style="color:#fde16d;"></i>
                                            {{ $row->description }}
                                            <i class="fas fa-quote-right" style="color:#fde16d;"></i>
                                            <input disabled id="rateStar" name="rateStar"
                                                class="ratings p-0 rating rating-loading" data-show-clear="false"
                                                data-show-caption="false" data-size="xs" value="{{ $row->star }}">
                                        </p>
                                    </div>
                                    <div class="testimonial__picture">
                                        <img src="/storage/{{ $row->image }}" alt="{{ $row->name }}"
                                            class="rounded-circle img-fluid">
                                    </div>
                                    <br>
                                    <div class="testimonial__name">
                                        <h6 style="color:white;">{{ $row->name }}</h3>
                                            {{-- <p class="fw-light">{{ $row->title }}</p> --}}
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
                        <center>
                            <div class="about-btn-area">
                                <a href="/testimonials" class="my-5 common-btn"
                                    style="background-color: #fde16d; color:black;">SELENGKAPNYA</a>
                            </div>
                        </center>
                    </div>
                </div>
            </div>

        </section>
    @endif
    <!-- End Testimonial -->

    <?php $sectionPost = \App\Models\Section::getSection('posts'); ?>
    @if ($sectionPost && Request::is('/'))
        <?php $posts = \App\Models\Post::with(['category', 'user'])
            ->where('status', 1)
            ->latest()
            ->simplePaginate(6); ?>
        <section class="blog-area three" style="background-color: #f9f9f9" id="berita">
            <div class="container">
                <div class="section-header"><span><?= $sectionPost->name ?></span>
                    <h2><?= $sectionPost->name ?></h2>
                </div>
                <div class="row">
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
                                            <i class="icofont-calendar" style="color: rgba(14, 29, 52, 0.9)"></i>
                                            <span>{{ date('d/m/Y', strtotime($row->created_at)) }}</span>
                                        </li>
                                        <li>
                                            <i class="icofont-user-alt-3" style="color: rgba(14, 29, 52, 0.9)"></i>
                                            <a href="/posts?author={{ $row->user->username }}">{{ $row->user->name }}</a>
                                        </li>
                                    </ul>
                                    <h6 class="post-category">
                                        <a
                                            href="/posts?category={{ $row->category->slug }}">{{ $row->category->name }}</a>
                                    </h6>
                                    <h3>
                                        <a href="/posts/{{ $row->slug }}">{{ $row->title }}</a>
                                    </h3>
                                    <div class="card border-0">
                                        <p>{{ Str::substr(strip_tags($row->body), 0, 98) }} ...</p>
                                    </div>
                                    <a class="blog-btn" style="color: rgba(14, 29, 52, 0.9)"
                                        href="/posts/{{ $row->slug }}">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <center>
                <div class="about-btn-area">
                    <a href="/posts" class="mt-3 common-btn"
                        style="background-color: rgba(14, 29, 52, 0.9)">SELENGKAPNYA</a>
                </div>
            </center>
        </section>
    @endif



    <?php $sectionPPID = \App\Models\Section::getSection('ppid'); ?>
    @if ($sectionPPID)
        <?php $ppid = \App\Http\Helpers\ApiPPID::getNews(); ?>
        <section class="blog-area three" id="berita">
            <div class="container">
                <div class="section-header"><span><?= $sectionPPID->name ?></span>
                    <h2><?= $sectionPPID->name ?></h2>
                </div>
                <div class="row">
                    @foreach (array_slice($ppid, 0, 6) as $row)
                        <div class="col-sm-6 col-lg-4">
                            <div class="blog-item">
                                <div class="top">
                                    <a target="_blank"
                                        href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">
                                        <img src="https://ppid.jemberkab.go.id/{{ str_replace('public/', 'storage/', $row['foto_berita']) }}"
                                            alt="{{ $row['judul_berita'] }}">
                                    </a>
                                </div>

                                <div class="bottom">
                                    <ul>
                                        <li>
                                            <i class="icofont-calendar" style="color: rgba(14, 29, 52, 0.9)"></i>
                                            <span>{{ date('d/m/Y', strtotime($row['created_at'])) }}</span>
                                        </li>
                                        <li>
                                            <i class="icofont-user-alt-3" style="color: rgba(14, 29, 52, 0.9)"></i>
                                            <a target="_blank"
                                                href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">{{ $row['diposting_oleh'] }}</a>
                                        </li>
                                    </ul>
                                    <h3>
                                        <a target="_blank"
                                            href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">{{ $row['judul_berita'] }}</a>
                                    </h3>
                                    <div class="card border-0">
                                        <p>{{ Str::substr(strip_tags($row['ringkasan_berita']), 0, 98) }} ...</p>
                                    </div>
                                    <a target="_blank" class="blog-btn" style="color: rgba(14, 29, 52, 0.9)"
                                        href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <center>
                <div class="about-btn-area">
                    <a href="/berita-ppid" class="my-3 common-btn"
                        style="background-color: rgba(14, 29, 52, 0.9)">SELENGKAPNYA</a>
                </div>
            </center>
        </section>
    @endif
@endsection
