<?php
$setting = \App\Models\Setting::firstWhere('id', 1);
$menus = \App\Models\Menu::where('child', null)
    ->orderBy('sort', 'ASC')
    ->get();
$footerMenus = App\Models\Menu::where('child', null)
    ->where('link', '!=', '#')
    ->orderBy('sort', 'ASC')
    ->get();
$sectionLink = App\Models\Section::getSection('links');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/frontend/icofont/icofont.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/icofont.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/meanmenu.css">
    <link rel="stylesheet" href="/assets/frontend/css/modal-video.min.css">
    <link rel="stylesheet" href="/assets/frontend/fonts/flaticon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
    <link rel="stylesheet" href="/assets/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/odometer.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
    <link rel="stylesheet" href="/assets/frontend/css/style.css">
    <link rel="stylesheet" href="/assets/frontend/css/responsive.css">
    <link rel="stylesheet" href="/assets/frontend/css/theme-dark.css">

    <link href="/assets/frontend/slider/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/frontend/slider/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/frontend/slider/css/owl.transitions.css" rel="stylesheet">
    <link href="/assets/frontend/slider/css/main.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />
    <style>
        .g-recaptcha {
            display: inline-block;
        }
    </style>
    <title>{{ $title_bar }}</title>
    <link rel="icon" type="image/png" href="/storage/{{ $setting->favicon }}">
</head>

<body>
    <div class="navbar-area sticky-top">

        <div class="mobile-nav">
            <a href="/" class="logo">
                <img src="/storage/{{ $setting->main_logo }}" alt="Logo">
            </a>
        </div>

        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="/">
                        <img src="/storage/{{ $setting->main_logo }}" class="logo-one" alt="Logo">
                        <img src="/storage/{{ $setting->sec_logo }}" class="logo-two" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            @foreach ($menus as $index => $row)
                                <?php $checkSubmenu = \App\Models\Menu::where('child', $row->id)->count(); ?>
                                @if ($checkSubmenu > 0)
                                    <?php $submenu = \App\Models\Menu::where('child', $row->id)
                                        ->orderBy('sort', 'ASC')
                                        ->get(); ?>
                                    <li class="nav-item">
                                        <a href="{{ $row->link }}"
                                            class="nav-link dropdown-toggle">{{ $row->name }} <i
                                                class="icofont-simple-down"></i></a>
                                        <ul class="dropdown-menu">
                                            @foreach ($submenu as $sub)
                                                <li class="nav-item">
                                                    <a href="{{ $sub->link }}"
                                                        class="nav-link">{{ $sub->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ $row->link }}">{{ $row->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="side-nav">
                            @if (auth()->user())
                                <a class="donate-btn btn-sm" href="/auth">
                                    Dashboard
                                </a>
                            @else
                                <a class="donate-btn btn-sm" href="/auth">
                                    Masuk
                                </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    @yield('content')

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
                    <?php $posts = \App\Models\Post::with(['postcategory', 'user'])
                        ->where('status_id', 2)
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


    <div class="go-top">
        <i class="icofont-arrow-up"></i>
        <i class="icofont-arrow-up"></i>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/frontend/js/form-validator.min.js"></script>
    <script src="/assets/frontend/js/contact-form-script.js"></script>
    <script src="/assets/frontend/js/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/frontend/js/jquery.meanmenu.js"></script>
    <script src="/assets/frontend/js/jquery-modal-video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="/assets/frontend/js/owl.carousel.min.js"></script>
    <script src="/assets/frontend/js/odometer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-appear/0.1/jquery.appear.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="/assets/frontend/js/custom.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-621c8314ac1c5ed7"></script>

    <script src="/assets/frontend/slider/js/owl.carousel.min.js"></script>
    <script src="/assets/frontend/slider/js/detect-browser.js"></script>
    <script src="/assets/frontend/slider/js/main.js"></script>
</body>

</html>
