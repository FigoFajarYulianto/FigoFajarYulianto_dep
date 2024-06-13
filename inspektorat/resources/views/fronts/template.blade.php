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
$links = App\Models\Link::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title_bar }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="/storage/{{ $setting->favicon }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/css/bootstrap-icons.css" rel="stylesheet">
    <link href="/frontend/css/all.min.css" rel="stylesheet">
    <link href="/frontend/css/glightbox.min.css" rel="stylesheet">
    <link href="/frontend/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="/frontend/css/aos.css" rel="stylesheet">
    <link href="/frontend/css/main.css" rel="stylesheet">
    <link href="/frontend/slider/css/owl.carousel.css" rel="stylesheet">
    <link href="/frontend/slider/css/owl.theme.css" rel="stylesheet">
    <link href="/frontend/slider/css/owl.transitions.css" rel="stylesheet">

    <link rel="stylesheet" href="/inspek/frontend/css/style.css">

    <link rel="stylesheet" href="/inspek/frontend/icofont/icofont.min.css">
    <link rel="stylesheet" href="/inspek/frontend/css/icofont.min.css">
    <link rel="stylesheet" href="/inspek/frontend/fonts/flaticon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" rel="stylesheet" type="text/css" />


    <style>
        b,
        strong {
            font-weight: bolder;
            font-size: 13px !important;
        }
    </style>


</head>

<body>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center" style="max-height: 50px;">
                @if ($setting->main_logo)
                    <img src="/storage/{{ $setting->main_logo }}" alt="{{ $setting->name }}">
                @else
                    <h1>{{ $setting->name }}</h1>
                @endif
            </a>
            <nav id="navbar" class="navbar" style="font-family: quicksand !important;">
                <ul>
                    @foreach ($menus as $index => $row)
                        <?php $checkSubmenu = \App\Models\Menu::where('child', $row->id)->count(); ?>
                        @if ($checkSubmenu > 0)
                            <?php $submenu = \App\Models\Menu::where('child', $row->id)
                                ->orderBy('sort', 'ASC')
                                ->get(); ?>
                            <li class="dropdown"><a 
                                    href="javascript:void(0)"><b>{{ $row->name }}</b> &nbsp;<iconify-icon
                                        icon="bi:chevron-down"></iconify-icon></a>
                                <ul>
                                    @foreach ($submenu as $sub)
                                        <li><a 
                                                href="{{ $sub->link }}"><b>{{ $sub->name }}</b></a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a  href="{{ $row->link }}"><b>{{ $row->name }}</b></a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
        </nav> <i class="mobile-nav-toggle mobile-nav-show">
            <iconify-icon icon="charm:menu-hamburger"></iconify-icon>
        </i><i class="mobile-nav-toggle mobile-nav-hide d-none">
            <iconify-icon icon="charm:menu-hamburger"></iconify-icon>
        </i>
    </header>
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
    <main id="main">
        @yield('content')
    </main>
    <footer class="footer-area pt-100" style="background-color: rgba(14, 29, 52, 0.9)">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-item">
                        <div class="footer-logo">
                            <a class="logo" href="/">
                                <img src="/storage/{{ $setting->sec_logo }}" alt="Logo">
                            </a>
                            <p style="align:justify">{{ $setting->description }}</p>
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
                                @if ($setting->whatsapp)
                                    <li>
                                        <a href="{{ $setting->whatsapp }}" target="_blank">
                                            <i class="icofont-brand-whatsapp"></i>
                                        </a>
                                    </li>
                                @endif
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
                    <?php $posts = \App\Models\Post::with(['category', 'user'])
                        ->where('status', 1)
                        ->latest()
                        ->simplePaginate(3); ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-causes">
                                <h3>{{ $sectionPost->name }}</h3>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.4.0/js/purecounter_vanilla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.1.3/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/js/purecounter_vanilla.js"></script>
    <script src="/frontend/js/glightbox.min.js"></script>
    <script src="/frontend/js/swiper-bundle.min.js"></script>
    <script src="/frontend/js/aos.js"></script>
    <script src="/frontend/js/validate.js"></script>
    <script src="/frontend/slider/js/owl.carousel.min.js"></script>
    <script src="/frontend/slider/js/detect-browser.js"></script>
    <script src="/frontend/slider/js/main.js"></script>

    <script src="/admin/dashboard/js/custom.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-621c8314ac1c5ed7"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>

    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
