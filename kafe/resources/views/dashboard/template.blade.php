<?php
$user = auth()->user();
$setting = App\Models\Setting::where('id', 1)->first();
if ($user) {
    $roles = explode(',', $user->level->access);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kafe Jogja</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="/admin2/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ '/storage/' . $setting->favicon }}" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

    <!-- Trix Buat Text -->
    <link rel="stylesheet" type="text/css" href="/admin/dashboard/css/trix.css">
    <script type="text/javascript" src="/admin/dashboard/js/trix.js"></script>

</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">{{ $setting->name_company }}</a>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/images/profile.png' }}" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/images/profile.png' }}" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">{{ $user->name }}</div>
                            <div class="dropdown-user-details-email">{{ $user->name }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/dashboard/profile">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Profile
                    </a>
                    <a class="dropdown-item" href="/" target="_blank">
                        <div class="dropdown-item-icon"><i data-feather="globe"></i></div>
                        Ke Website
                    </a>
                    <a class="dropdown-item" href="/auth/logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <!-- Sidenav Menu Heading (Account)-->
                        <!-- Sidenav Menu Heading (Core)-->
                        <div class="sidenav-menu-heading">Menu Utama</div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <a class="nav-link" href="/dashboard1">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        <!-- Sidenav Heading (Custom)-->
                        <div class="sidenav-menu-heading">Pilihan Menu</div>
                        <!-- Sidenav Accordion (Pages)-->
                        @if (in_array('users.index', $roles) ||
                        in_array('levels.index', $roles) ||
                        in_array('categories.index', $roles) ||
                        in_array('statusorders.index', $roles) ||
                        in_array('settings.index', $roles) ||
                        in_array('menus.index', $roles) ||
                        in_array('categoryconsultations.index', $roles) ||
                        in_array('statusconsultations.index', $roles) ||
                        in_array('whatsapp.scan', $roles) ||
                        in_array('whatsapp.index', $roles))
                        <a class="{{ Request::is('dashboard/users*') ||
                            Request::is('dashboard/levels*') ||
                            Request::is('dashboard/categories*') ||
                            Request::is('dashboard/statusorders*') ||
                            Request::is('dashboard/categoryconsultations*') ||
                            Request::is('dashboard/statusconsultations*') ||
                            Request::is('dashboard/whatsapp/scan*') ||
                            Request::is('dashboard/whatsapp/histories*')
                                ? 'nav-link' : 'nav-link collapsed' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="{{ Request::is('dashboard/users*') ||
                                Request::is('dashboard/levels*') ||
                                Request::is('dashboard/categories*') ||
                                Request::is('dashboard/statusorders*') ||
                                Request::is('dashboard/categoryconsultations*') ||
                                Request::is('dashboard/statusconsultations*') ||
                                Request::is('dashboard/whatsapp/scan*') ||
                                Request::is('dashboard/whatsapp/histories*')
                                    ? 'true'
                                    : 'false' }}" aria-controls="collapsePages">
                            <div class="nav-link-icon"><i data-feather="grid"></i></div>
                            Master Data
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="{{ Request::is('dashboard/users*') ||
                            Request::is('dashboard/levels*') ||
                            Request::is('dashboard/categories*') ||
                            Request::is('dashboard/statusorders*') ||
                            Request::is('dashboard/categoryconsultations*') ||
                            Request::is('dashboard/statusconsultations*') ||
                            Request::is('dashboard/whatsapp/scan*') ||
                            Request::is('dashboard/whatsapp/histories*')
                                ? 'collapse show'
                                : 'collapse' }}" id="collapsePages" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                @if (in_array('users.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">Data User</a>
                                @endif
                                @if (in_array('levels.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/levels*') ? 'active' : '' }}" href="/dashboard/levels">Level User</a>
                                @endif
                                @if (in_array('categories.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">Kategori Hidangan</a>
                                @endif
                                @if (in_array('statusorders.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/statusorders*') ? 'active' : '' }}" href="/dashboard/statusorders">Status Order</a>
                                @endif
                                @if (in_array('categoryconsultations.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/categoryconsultations*') ? 'active' : '' }}" href="/dashboard/categoryconsultations">Kategori Konsultasi</a>
                                @endif
                                @if (in_array('statusconsultations.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/statusconsultations*') ? 'active' : '' }}" href="/dashboard/statusconsultations">Status Konsultasi</a>
                                @endif
                                @if (in_array('whatsapp.scan', $roles))
                                <a class="nav-link {{ Request::is('dashboard/statusconsultations*') ? 'active' : '' }}" href="/dashboard/whatsapp/scan">Status & Scan<br>Whatsapp</a>
                                @endif
                                @if (in_array('whatsapp.index', $roles))
                                <a class="nav-link" href="/dashboard/whatsapp/histories">Whatsapp History</a>
                                @endif
                            </nav>
                        </div>
                        @endif
                        @if (in_array('menus.index', $roles))
                        <a class="nav-link {{ Request::is('dashboard/menus*') ? 'active' : '' }}" href="/dashboard/menus">
                            <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                            Menu
                        </a>
                        @endif
                        <!-- Sidenav Link (Tables)-->
                        @if (in_array('orders.index', $roles))
                        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
                            <div class="nav-link-icon"><i data-feather="coffee"></i></div>
                            Order Kasir
                        </a>
                        @endif

                        @if (in_array('orderskasir.index', $roles))
                        <a class="nav-link {{ Request::is('dashboard/kasir/orders*') ? 'active' : '' }}" href="/dashboard/kasir/orders">
                            <div class="nav-link-icon"><i data-feather="coffee"></i></div>
                            Order Kasir
                        </a>
                        @endif

                        @if (in_array('pendapatans.index', $roles))
                        <a class="nav-link {{ Request::is('dashboard/pendapatans*') ? 'active' : '' }}" href="/dashboard/pendapatans">
                            <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                            Pendapatan
                        </a>
                        @endif

                        @if (in_array('konsultasi.index', $roles))
                        <a class="nav-link" href="/dashboard/konsultasi">
                            <div class="nav-link-icon"><i data-feather="users"></i></div>
                            Konsultasi
                        </a>
                        @endif
                        <!-- @if (in_array('consultationreplies.index', $roles))
                        <a class="nav-link {{ Request::is('dashboard/consultationreplies*') ? 'active' : '' }}" href="/dashboard/consultationreplies">
                            <div class="nav-link-icon"><i data-feather="message-circle"></i></div>
                            Balasan Konsultasi
                        </a>
                        @endif -->
                        @if (in_array('settings.index', $roles))
                        <a class="nav-link {{ Request::is('dashboard/settings*') ? 'active' : '' }}" href="/dashboard/settings">
                            <div class="nav-link-icon"><i data-feather="settings"></i></div>
                            Pengaturan
                        </a>
                        @endif
                    </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Login Sebagai:</div>
                        <div class="sidenav-footer-title">{{ $user->name }}</div>
                    </div>
                </div>
            </nav>
        </div>
        @yield('content')
    </div>
    {{-- modal dialog level --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/admin/dashboard/js/custom.js"></script>
    <script src="/admin2/js/scripts.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="/admin2/assets/demo/chart-area-demo.js"></script> -->
    <!-- <script src="/admin2/assets/demo/chart-bar-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/admin2/js/datatables/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="/admin2/js/litepicker.js"></script>

    @yield('script')
</body>

</html>