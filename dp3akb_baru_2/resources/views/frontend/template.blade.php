<?php
$setting = \App\Models\Setting::where('id', 1)->first();
$menus = \App\Models\Menu::where('child', null)
    ->orderBy('sort', 'ASC')
    ->get();
$footerMenus = App\Models\Menu::where('child', null)
    ->where('link', '!=', '#')
    ->orderBy('sort', 'ASC')
    ->get();
$sectionLink = App\Models\Section::getSection('links');
// $links = App\Models\Link::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title_bar }}</title>
    <link href="/storage/{{ $setting->favicon }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="/assets/frontend/slider/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/frontend/slider/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/frontend/slider/css/owl.transitions.css" rel="stylesheet">
    <link href="/assets/frontend/slider/css/main.css" rel="stylesheet">

    {{-- Template --}}
    <link rel="stylesheet" href="/assets/frontend/icofont/icofont.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/icofont.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/meanmenu.css">
    <link rel="stylesheet" href="/assets/frontend/css/modal-video.min.css">
    <link rel="stylesheet" href="/assets/frontend/fonts/flaticon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
    <link rel="stylesheet" href="/assets/frontend/css/odometer.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
    <link rel="stylesheet" href="/assets/frontend/css/style.css">
    {{-- <link rel="stylesheet" href="/assets/frontend/css/fullPage.css"> --}}
    {{-- <link rel="stylesheet" href="/assets/frontend/css/responsive.css"> --}}
    <link rel="stylesheet" href="/assets/frontend/css/theme-dark.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" rel="stylesheet" type="text/css" />
    <style>
        .g-recaptcha {
            display: inline-block;
        }

        .testimonials {
            position: relative;
            padding: 0;
            background: linear-gradient(to right, #a2e0ff, #0298e1);
        }

        .testimonials__card {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem 1.25rem;
            border-radius: 0.625rem;
            height: auto;
            text-align: center;
        }

        .testimonials__card i {
            font-size: 1.5rem;
            color: #0298e1;
        }

        .testimonials__card .ratings i {
            color: #0298e1;
            font-size: 1rem;
        }

        .testimonials__picture {
            width: 6rem;
            height: 6rem;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .testimonials__picture img {
            border: 0.325rem solid #0298e1;
        }

        .testimonials__name {
            padding-top: 3rem;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 500;
            color: #fff;
        }

        .testimonials__name h3 {
            padding-top: 0.8rem;
            text-transform: capitalize;
        }

        .testimonials__name p {
            padding-bottom: 2rem;
            text-transform: capitalize;
        }

        .selengkapnyasurvey a {
            color: #fff;
            background-color: #ff6015;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
        }

        .selengkapnyasurvey a i {
            display: inline-block;
            margin-left: 3px;
            font-size: 14px;
            -webkit-animation: heart-beat 2s infinite linear;
            animation: heart-beat 2s infinite linear;
        }

        .selengkapnyasurvey a:hover {
            background-color: #302c51;
        }
    </style>
</head>

<body>
    <div class="colorprimary header container-fluid sticked bg-transparent">
        <header id="header" class="container d-flex align-items-center">
            <a href="/" class="logo">
                @if ($setting->main_logo)
                    <img class="logo-img" src="/storage/{{ $setting->main_logo }}" alt="{{ $setting->name }}">
                @else
                    <h1>{{ $setting->name }}</h1>
                @endif
            </a>
            <div class="container d-flex align-items-center justify-content-end pt-2">
                <nav id="navbar" class="navbar">
                    <ul>
                        @foreach ($menus as $index => $row)
                            <?php $checkSubmenu = \App\Models\Menu::where('child', $row->id)->count(); ?>
                            @if ($checkSubmenu > 0)
                                <?php $submenu = \App\Models\Menu::where('child', $row->id)
                                    ->orderBy('sort', 'ASC')
                                    ->get(); ?>
                                <li class="dropdown"><a href="javascript:void(0)">{{ $row->name }} &nbsp;<i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        @foreach ($submenu as $sub)
                                            <li><a href="{{ $sub->link }}">{{ $sub->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ $row->link }}">{{ $row->name }}</a></li>
                            @endif
                        @endforeach

                        @if (auth()->user())
                            <div class="side-nav" id="login-nav">

                                <a class="donate-btn btn-sm" href="/auth">
                                    Dashboard
                                </a>

                            </div>
                        @endif

                    </ul>
                </nav>
            </div>
            {{-- <div class="side-nav" id="side-nav" style="margin-right: 20px;">
                @if (auth()->user())
                    <a class="donate-btn btn-sm" href="/auth">
                        Dashboard
                    </a>
                @else
                    <a class="donate-btn btn-sm" href="/auth">
                        Masuk
                    </a>
                @endif
            </div> --}}
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list py-3"></i> <i
                class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x py-3"></i>
        </header>
    </div>
    <main id="main">
        @yield('content')
    </main>
    <footer class="footer-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-logo">
                            <a class="logo" href="/">
                                <img src="/storage/{{ $setting->sec_logo }}" alt="Logo">
                            </a>
                            <p>{{ $setting->description }}</p>
                            <ul>
                                @if ($setting->facebook)
                                    <li>
                                        <a href="{{ $setting->facebook }}" target="_blank">
                                            <i class="icofont-facebook"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($setting->twitter)
                                    <li>
                                        <a href="{{ $setting->twitter }}" target="_blank">
                                            <i class="icofont-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($setting->email)
                                    <li>
                                        <a href="mailto:{{ $setting->email }}" target="_blank">
                                            <i class="icofont-email"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($setting->instagram)
                                    <li>
                                        <a href="{{ $setting->instagram }}" target="_blank">
                                            <i class="icofont-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                                {{-- @if ($setting->whatsapp)
                                    <li>
                                        <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank">
                                <i class="icofont-brand-whatsapp"></i>
                                </a>
                                </li>
                                @endif --}}
                                @if ($setting->telegram)
                                    <li>
                                        <a href="{{ $setting->telegram }}" target="_blank">
                                            <i class="icofont-telegram"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($setting->youtube)
                                    <li>
                                        <a href="{{ $setting->youtube }}" target="_blank">
                                            <i class="icofont-youtube-play"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <?php $sectionPost = \App\Models\Section::getSection('posts'); ?>
                @if ($sectionPost)
                    <?php $posts = \App\Models\Post::with(['postcategory', 'user'])
                        ->where('status', 1)
                        ->latest()
                        ->simplePaginate(3); ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-causes">
                                <h3>Berita Terbaru</h3>
                                @foreach ($posts as $row)
                                    <div class="cause-inner">
                                        <ul class="align-items-center">
                                            <li>
                                                <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}">
                                            </li>
                                            <li>
                                                <h3>
                                                    <a href="/post/{{ $row->slug }}">{{ $row->title }}</a>
                                                </h3>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-links">
                            <h3>Menu Utama</h3>
                            <ul>
                                @foreach ($menus as $index => $row)
                                    <?php $checkSubmenu = \App\Models\Menu::where('child', $row->id)->count(); ?>
                                    @if ($checkSubmenu <= 0 && $row->link != '#')
                                        <li>
                                            <a href="{{ $row->link }}">
                                                <i class="icofont-simple-right"></i>
                                                {{ $row->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-contact">
                            <h3>Hubungi Kami</h3>
                            <div class="contact-inner">
                                <ul>
                                    @if ($setting->address)
                                        <li>
                                            <i class="fas fa-map-marker fa-sm"></i><label
                                                style="color: white">{{ $setting->address }}</label>
                                        </li>
                                    @endif
                                    @if ($setting->telp)
                                        <li>
                                            <i class="fas fa-phone fa-sm"></i><label
                                                style="color: white">{{ $setting->telp }}</label>
                                        </li>
                                    @endif
                                    @if ($setting->email)
                                        <li>
                                            <i class="fas fa-envelope fa-sm"></i><label
                                                style="color: white">{{ $setting->email }}</label>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <p>&copy; {{ date('Y') }} {{ Str::upper($setting->name) }}</p>
            </div>
        </div>
    </footer>

    @if ($setting->whatsapp)
        <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank" class="buy-now-btn"><i
                class="fab fa-whatsapp me-1"></i> WhatsApp</a>
    @endif

    {{-- <div class="go-top active">
        <i class="icofont-arrow-up"></i>
        <i class="icofont-arrow-up"></i>
    </div> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.4.0/js/purecounter_vanilla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.1.3/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/frontend/slider/js/owl.carousel.min.js"></script>
    <script src="/assets/frontend/slider/js/detect-browser.js"></script>
    <script src="/assets/frontend/slider/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollify/1.0.21/jquery.scrollify.min.js"
        integrity="sha512-UyX8JsMsNRW1cYl8BoxpcamonpwU2y7mSTsN0Z52plp7oKo1u92Xqfpv6lOlTyH3yiMXK+gU1jw0DVCsPTfKew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/assets/js/custom.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-621c8314ac1c5ed7"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>
    @yield('script')
</body>

</html>
