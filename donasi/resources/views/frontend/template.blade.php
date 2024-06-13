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
    <link rel="stylesheet" href="/assets/frontend/css/zakatcalculator.css">
    {{-- <link rel="stylesheet" href="/assets/frontend/css/responsive.css"> --}}
    <link rel="stylesheet" href="/assets/frontend/css/theme-dark.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        .g-recaptcha {
            display: inline-block;
        }

        .invalid input:required:invalid {
            background: #BE4C54;
        }

        /* Mark valid inputs during .invalid state */
        .invalid input:required:valid {
            background: #17D654;
        }
    </style>
</head>

<body>
    <div class="colorprimary header container-fluid sticked bg-transparent">
        <header id="header" class="container d-flex align-items-center">
            <a href="/" class="logo">
                @if ($setting->main_logo)
                    <img src="/storage/{{ $setting->main_logo }}" alt="{{ $setting->name }}">
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
                            <li><a href="/dashboard" class="active">Dashboard</a></li>
                        @else
                            <li><a href="/auth" class="active">DAFTAR</a></li>
                        @endif
                        {{-- <div class="login-nav">
                            <div class="side-nav" id="login-nav">
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
                        </div> --}}
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

    {{-- @if ($setting->whatsapp)
        <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank">
            <img src="/assets/img/default_whatsapp.png" class="wa-btn" width="50px;"></a>
    @endif
    @if ($setting->email)
        <a href="https://wa.me/{{ $setting->email }}" target="_blank">
            <img src="/assets/img/default_email.png" class="email-btn" width="50px;"></a>
    @endif --}}
    {{-- <div class="norm_row sfsi_wDiv sfsi_floater_position_center-right" id="sfsi_floater"
        style="z-index: 9999;width:45px;text-align:left;position:absolute;position:absolute;right:30px;top:50%;margin-right:0px;">
        @if ($setting->email)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='mailto: {{ $setting->email }}' id='sfsiid_email_icon'
                        style='width:40px;height:40px;opacity:1;'><img data-pin-nopin='true' alt='Follow by Email'
                            title='Follow by Email'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_email.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
        @if ($setting->facebook)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='{{ $setting->facebook }}' id='sfsiid_facebook_icon'
                        style='width:40px;height:40px;opacity:1;'><img data-pin-nopin='true' alt='Facebook'
                            title='Facebook'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_facebook.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
        @if ($setting->instagram)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='' id='sfsiid_facebook_icon' style='width:40px;height:40px;opacity:1;'><img
                            data-pin-nopin='true' alt='Instagram' title='Instagram'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_instagram.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
        @if ($setting->telegram)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='' id='sfsiid_facebook_icon' style='width:40px;height:40px;opacity:1;'><img
                            data-pin-nopin='true' alt='Telegram' title='Telegram'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_telegram.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
        @if ($setting->youtube)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='' id='sfsiid_facebook_icon' style='width:40px;height:40px;opacity:1;'><img
                            data-pin-nopin='true' alt='Youtube' title='Youtube'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_youtube.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
        @if ($setting->twitter)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='' id='sfsiid_twitter_icon' style='width:40px;height:40px;opacity:1;'><img
                            data-pin-nopin='true' alt='Twitter' title='Twitter'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_twitter.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
        @if ($setting->whatsapp)
            <div style='width:40px; height:40px;margin-left:5px;margin-bottom:5px; ' class='sfsi_wicons shuffeldiv '>
                <div class='inerCnt'><a class=' sficn' data-effect='' target='_blank' rel='noopener'
                        href='https://wa.me/{{ $setting->whatsapp }}' id='sfsiid_whatsapp_icon'
                        style='width:40px;height:40px;opacity:1;'><img data-pin-nopin='true' alt='WhatsApp'
                            title='WhatsApp'
                            src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/images/icons_theme/default/default_whatsapp.png'
                            width='40' height='40' style='' class='sfcm sfsi_wicon '
                            data-effect='' /></a>
                </div>
            </div>
        @endif
    </div><input type='hidden' id='sfsi_floater_sec' value='center-right' /> --}}


    <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank">
        <img src="/assets/img/default_whatsapp.png" class="wa-btn" width="50px;"></a>


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
    <script src="/assets/js/custom.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-621c8314ac1c5ed7"></script>
    {{ $setting->code }}

    {{-- socmed --}}
    <script>
        window.addEventListener("sfsi_functions_loaded", function() {
            if (typeof sfsi_widget_set == "function") {
                sfsi_widget_set();
            }
        });
        window.addEventListener('sfsi_functions_loaded', function() {
            var topalign = (jQuery(window).height() - jQuery('#sfsi_floater').height()) / 2;
            jQuery('#sfsi_floater').css('top', topalign);
            sfsi_float_widget('center');
        });
    </script>
    <script src='https://kabdemak.baznas.go.id/core/modules/ee54ac9a73/js/mystickymenu.min.js' id='mystickymenu-js'>
    </script>
    <script src='https://kabdemak.baznas.go.id/core/modules/ultimate-social-media-icons/js/custom.js' id='SFSICustomJs-js'>
    </script>

    {{-- Animator count --}}
    <script src='https://kabdemak.baznas.go.id/core/modules/f65f29574d/assets/lib/jquery-numerator/jquery-numerator.min.js'
        id='jquery-numerator-js'></script>
    <script src='https://kabdemak.baznas.go.id/core/modules/f65f29574d/assets/js/webpack.runtime.min.js'
        id='elementor-webpack-runtime-js'></script>
    <script src='https://kabdemak.baznas.go.id/core/modules/f65f29574d/assets/js/frontend-modules.min.js'
        id='elementor-frontend-modules-js'></script>
    <script id='elementor-frontend-js-before'>
        var elementorFrontendConfig = {
            "environmentMode": {
                "edit": false,
                "wpPreview": false,
                "isScriptDebug": false
            },
            "i18n": {
                "shareOnFacebook": "Share on Facebook",
                "shareOnTwitter": "Share on Twitter",
                "pinIt": "Pin it",
                "download": "Download",
                "downloadImage": "Download image",
                "fullscreen": "Fullscreen",
                "zoom": "Zoom",
                "share": "Share",
                "playVideo": "Play Video",
                "previous": "Previous",
                "next": "Next",
                "close": "Close"
            },
            "is_rtl": false,
            "breakpoints": {
                "xs": 0,
                "sm": 480,
                "md": 768,
                "lg": 1025,
                "xl": 1440,
                "xxl": 1600
            },
            "responsive": {
                "breakpoints": {
                    "mobile": {
                        "label": "Mobile",
                        "value": 767,
                        "default_value": 767,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "mobile_extra": {
                        "label": "Mobile Extra",
                        "value": 880,
                        "default_value": 880,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "tablet": {
                        "label": "Tablet",
                        "value": 1024,
                        "default_value": 1024,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "tablet_extra": {
                        "label": "Tablet Extra",
                        "value": 1200,
                        "default_value": 1200,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "laptop": {
                        "label": "Laptop",
                        "value": 1366,
                        "default_value": 1366,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "widescreen": {
                        "label": "Widescreen",
                        "value": 2400,
                        "default_value": 2400,
                        "direction": "min",
                        "is_enabled": false
                    }
                }
            },
            "version": "3.7.4",
            "is_static": false,
            "experimentalFeatures": {
                "e_dom_optimization": true,
                "e_optimized_assets_loading": true,
                "e_optimized_css_loading": true,
                "a11y_improvements": true,
                "additional_custom_breakpoints": true,
                "e_import_export": true,
                "e_hidden_wordpress_widgets": true,
                "landing-pages": true,
                "elements-color-picker": true,
                "favorite-widgets": true,
                "admin-top-bar": true
            },
            "urls": {
                "assets": "https:\/\/kabdemak.baznas.go.id\/core\/modules\/f65f29574d\/assets\/"
            },
            "settings": {
                "page": [],
                "editorPreferences": []
            },
            "kit": {
                "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
                "global_image_lightbox": "yes",
                "lightbox_enable_counter": "yes",
                "lightbox_enable_fullscreen": "yes",
                "lightbox_enable_zoom": "yes",
                "lightbox_enable_share": "yes",
                "lightbox_title_src": "title",
                "lightbox_description_src": "description"
            },
            "post": {
                "id": 7,
                "title": "Home%20-%20Baznas%20Kab%20Demak",
                "excerpt": "",
                "featuredImage": false
            }
        };
    </script>
    <script src='https://kabdemak.baznas.go.id/core/modules/f65f29574d/assets/js/frontend.min.js'
        id='elementor-frontend-js'></script>

    @yield('script')
</body>

</html>
