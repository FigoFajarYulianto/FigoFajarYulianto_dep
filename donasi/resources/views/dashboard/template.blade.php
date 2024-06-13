<?php
$level = new App\Models\Level();

$bagian = $level::where('id', auth()->user()->level_id)->first();
$roles = explode(',', $bagian['access']);
$setting = App\Models\Setting::firstWhere('id', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $title_bar }}</title>
    <link rel="icon" type="image/png" href="/storage/{{ $setting->favicon }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="/assets/backend/css/trix.css">
    <script type="text/javascript" src="/assets/backend/js/trix.js"></script>
    <style>
        a {
            text-decoration: none !important;
        }

        .watermarked {
            position: relative;
            overflow: hidden;
            text-align: center
        }

        .watermarked img {
            width: 100%;
        }

        .watermarked::before {
            position: absolute;
            top: -75%;
            left: -75%;

            display: block;
            width: 150%;
            height: 150%;

            transform: rotate(-45deg);
            content: attr(data-watermark);

            opacity: 0.3;
            line-height: 3em;
            letter-spacing: 2px;
            color: rgb(0, 104, 223);
        }

        #atf-map-area iframe {
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
        id="sidenavAccordion">
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
                data-feather="menu"></i></button>
        <a class="navbar-brand pe-3 ps-4 ps-lg-2 text-uppercase" href="/dashboard">{{ Str::upper($setting->name) }}</a>
        <ul class="navbar-nav align-items-center ms-auto">
            <li class="nav-item d-md-block me-3">
                <a href="/" class="nav-link" target="_blank">Lihat Situs</a>
            </li>
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><img class="img-fluid"
                        src="{{ auth()->user()->photo ? '/storage/' . auth()->user()->photo : '/assets/img/profile.png' }}" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img"
                            src="{{ auth()->user()->photo ? '/storage/' . auth()->user()->photo : '/assets/img/profile.png' }}" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name mb-2">{{ auth()->user()->name }}</div>
                            <div class="dropdown-user-details-email">{{ '@' . auth()->user()->username }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/dashboard/profile">
                        <div class="dropdown-item-icon"><i data-feather="user"></i></div>
                        Profil
                    </a>
                    @if (in_array('settings.index', $roles))
                        <a class="dropdown-item" href="/dashboard/settings">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Pengaturan Web
                        </a>
                    @endif
                    <a class="dropdown-item" href="/auth/logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Keluar
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
                        <div class="sidenav-menu-heading">Selamat Datang</div>
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        @if (in_array('levels.index', $roles) ||
                            in_array('users.index', $roles) ||
                            in_array('provinces.index', $roles) ||
                            in_array('districts.index', $roles) ||
                            in_array('subdistricts.index', $roles) ||
                            in_array('categories.index', $roles) ||
                            in_array('postcategories.index', $roles) ||
                            in_array('Link Terkait.index', $roles) ||
                            in_array('statuses.index', $roles) ||
                            in_array('banks.index', $roles) ||
                            in_array('Dana.index', $roles) ||
                            in_array('Kategori Dana.index', $roles) ||
                            in_array('Whatsapp.index', $roles))
                            <a class="{{ Request::is('dashboard/levels*') || Request::is('dashboard/users*') || Request::is('dashboard/provinces*') || Request::is('dashboard/districts*') || Request::is('dashboard/subdistricts*') || Request::is('dashboard/categories*') || Request::is('dashboard/postcategories*') || Request::is('dashboard/links*') || Request::is('dashboard/statuses*') || Request::is('dashboard/banks*') || Request::is('dashboard/danas*') || Request::is('dashboard/danacategories*') || Request::is('dashboard/whatsapp*') ? 'nav-link' : 'nav-link collapsed' }}"
                                href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApp"
                                aria-expanded="{{ Request::is('dashboard/levels*') || Request::is('dashboard/users*') || Request::is('dashboard/provinces*') || Request::is('dashboard/districts*') || Request::is('dashboard/subdistricts*') || Request::is('dashboard/categories*') || Request::is('dashboard/postcategories*') || Request::is('dashboard/links*') || Request::is('dashboard/statuses*') || Request::is('dashboard/banks*') || Request::is('dashboard/danas*') || Request::is('dashboard/danacategories*') || Request::is('dashboard/whatsapp*') ? 'true' : 'false' }}"
                                aria-controls="collapseApps">
                                <div class="nav-link-icon"><i data-feather="database"></i></div>
                                Master Data
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="{{ Request::is('dashboard/levels*') || Request::is('dashboard/users*') || Request::is('dashboard/provinces*') || Request::is('dashboard/districts*') || Request::is('dashboard/subdistricts*') || Request::is('dashboard/categories*') || Request::is('dashboard/postcategories*') || Request::is('dashboard/links*') || Request::is('dashboard/statuses*') || Request::is('dashboard/banks*') || Request::is('dashboard/danas*') || Request::is('dashboard/danacategories*') || Request::is('dashboard/whatsapp*') ? 'collapse show' : 'collapse' }}"
                                id="collapseApp" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    @if (in_array('levels.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/levels*') ? 'active' : '' }}'
                                            href='/dashboard/levels'>Level</a>
                                    @endif
                                    @if (in_array('users.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}'
                                            href='/dashboard/users'>User</a>
                                    @endif
                                    @if (in_array('banks.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/banks*') ? 'active' : '' }}'
                                            href='/dashboard/banks'>Bank</a>
                                    @endif
                                    @if (in_array('Kategori Dana.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/danacategories*') ? 'active' : '' }}'
                                            href='/dashboard/danacategories'>Kategori Dana</a>
                                    @endif
                                    @if (in_array('Dana.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/danas*') ? 'active' : '' }}'
                                            href='/dashboard/danas'>Dana</a>
                                    @endif
                                    @if (in_array('provinces.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/provinces*') ? 'active' : '' }}'
                                            href='/dashboard/provinces'>Provinsi</a>
                                    @endif
                                    @if (in_array('districts.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/districts*') ? 'active' : '' }}'
                                            href='/dashboard/districts'>Kabupaten</a>
                                    @endif
                                    @if (in_array('subdistricts.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/subdistricts*') ? 'active' : '' }}'
                                            href='/dashboard/subdistricts'>Kecamatan</a>
                                    @endif
                                    @if (in_array('categories.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}'
                                            href='/dashboard/categories'>Kategori Kampanye</a>
                                    @endif
                                    @if (in_array('postcategories.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/postcategories*') ? 'active' : '' }}'
                                            href='/dashboard/postcategories'>Kategori Berita</a>
                                    @endif
                                    @if (in_array('statuses.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/statuses*') ? 'active' : '' }}'
                                            href='/dashboard/statuses'>Status</a>
                                    @endif
                                    @if (in_array('Link Terkait.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/links*') ? 'active' : '' }}'
                                            href='/dashboard/links'>Link Terkait</a>
                                    @endif
                                    @if (in_array('Whatsapp.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/whatsapp*') ? 'active' : '' }}'
                                            href='/dashboard/whatsapp'>Whatsapp</a>
                                    @endif
                                </nav>
                            </div>
                        @endif

                        @if (in_array('sections.index', $roles) ||
                            in_array('menus.index', $roles) ||
                            in_array('sliders.index', $roles) ||
                            in_array('abouts.index', $roles) ||
                            in_array('goals.index', $roles) ||
                            in_array('callToAction.index', $roles))
                            <a class="{{ Request::is('dashboard/sections*') || Request::is('dashboard/menus*') || Request::is('dashboard/sliders*') || Request::is('dashboard/abouts*') || Request::is('dashboard/goals*') ? 'nav-link' : 'nav-link collapsed' }}"
                                href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApps"
                                aria-expanded="{{ Request::is('dashboard/sections*') || Request::is('dashboard/menus*') || Request::is('dashboard/sliders*') || Request::is('dashboard/abouts*') || Request::is('dashboard/goals*') || Request::is('dashboard/callToAction*') ? 'true' : 'false' }}"
                                aria-controls="collapseApps">
                                <div class="nav-link-icon"><i data-feather="layout"></i></div>
                                Layout
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="{{ Request::is('dashboard/sections*') || Request::is('dashboard/menus*') || Request::is('dashboard/sliders*') || Request::is('dashboard/abouts*') || Request::is('dashboard/goals*') || Request::is('dashboard/callToAction*') ? 'collapse show' : 'collapse' }}"
                                id="collapseApps" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    @if (in_array('sections.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/sections*') ? 'active' : '' }}'
                                            href='/dashboard/sections'>Section</a>
                                    @endif
                                    @if (in_array('menus.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/menus*') ? 'active' : '' }}'
                                            href='/dashboard/menus'>Menu</a>
                                    @endif
                                    @if (in_array('sliders.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/sliders*') ? 'active' : '' }}'
                                            href='/dashboard/sliders'>Slider</a>
                                    @endif
                                    @if (in_array('callToAction.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/callToAction*') ? 'active' : '' }}'
                                            href='/dashboard/callToAction'>Call To Action</a>
                                    @endif
                                    @if (in_array('Lapor Bencana.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/laporbencana*') ? 'active' : '' }}'
                                            href='/dashboard/laporbencana'>Lapor Bencana</a>
                                    @endif
                                    @if (in_array('abouts.index', $roles))
                                        <a class='nav-link {{ Request::is('dashboard/abouts*') ? 'active' : '' }}'
                                            href='/dashboard/abouts'>Tentang Kami</a>
                                    @endif
                                </nav>
                            </div>
                        @endif

                        {{-- Pages --}}
                        @if (in_array('pages.index', $roles) ||
                            in_array('posts.index', $roles) ||
                            in_array('comments.index', $roles) ||
                            in_array('zakatcollectionunits.index', $roles))
                            <div class="sidenav-menu-heading">PAGES</div>
                            @if (in_array('pages.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/pages*') ? 'active' : '' }}"
                                    href="/dashboard/pages">
                                    <div class="nav-link-icon"><i data-feather="file"></i></div>
                                    Halaman
                                </a>
                            @endif
                            @if (in_array('posts.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}"
                                    href="/dashboard/posts">
                                    <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                                    Berita
                                </a>
                            @endif
                            @if (in_array('comments.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/comments*') ? 'active' : '' }}"
                                    href="/dashboard/comments">
                                    <div class="nav-link-icon"><i data-feather="message-circle"></i></div>
                                    Komentar
                                </a>
                            @endif
                            @if (in_array('zakatcollectionunits.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/zakatcollectionunits*') ? 'active' : '' }}"
                                    href="/dashboard/zakatcollectionunits">
                                    <div class="nav-link-icon"><i class="fa fa-building-columns"></i></div>
                                    Unit Pengumpulan Zakat
                                </a>
                            @endif
                        @endif

                        {{-- Menu Admin --}}
                        @if (in_array('Penarikan Dana Kampanye.index', $roles) || in_array('Data Penarikan Dana.index', $roles))
                            <div class="sidenav-menu-heading">MENU ADMIN</div>
                            @if (in_array('Penarikan Dana Kampanye.index', $roles))
                                <a class='nav-link {{ Request::is('dashboard/campaignfundwithdrawals*') ? 'active' : '' }}'
                                    href='/dashboard/campaignfundwithdrawals'>
                                    <div class='nav-link-icon'><i class="fas fa-hand-holding-usd"></i></div>
                                    Data Penarikan Jember Super Charity
                                </a>
                            @endif
                            @if (in_array('Data Penarikan Dana.index', $roles))
                                <a class='nav-link {{ Request::is('dashboard/verifikasidanawithdrawals*') ? 'active' : '' }}'
                                    href='/dashboard/verifikasidanawithdrawals'>
                                    <div class='nav-link-icon'><i class="fas fa-hand-holding-usd"></i></div>
                                    Data Penarikan Dana
                                </a>
                            @endif
                        @endif

                        {{-- Menu Utama --}}
                        @if (in_array('campaigns.index', $roles) ||
                            in_array('zakats.index', $roles) ||
                            in_array('Laporan Bencana.index', $roles))
                            <div class="sidenav-menu-heading">MENU UTAMA</div>
                            @if (in_array('campaigns.index', $roles))
                                <a class='nav-link {{ Request::is('dashboard/campaigns*') ? 'active' : '' }}'
                                    href='/dashboard/campaigns'>
                                    <div class='nav-link-icon'><i class="fas fa-hand-holding-heart"></i></div>
                                    Jember Super Charity
                                </a>
                            @endif
                            @if (in_array('Data Dana.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/datadanas*') ? 'active' : '' }}"
                                    href="/dashboard/datadanas">
                                    <div class="nav-link-icon"><i class="fa fa-building-columns"></i></div>
                                    Data Dana
                                </a>
                            @endif
                            @if (in_array('Laporan Bencana.index', $roles))
                                <a class="nav-link {{ Request::is('dashboard/laporanbencanas*') ? 'active' : '' }}"
                                    href="/dashboard/laporanbencanas">
                                    <div class="nav-link-icon"><i class="fa fa-newspaper"></i></div>
                                    Laporan Bencana
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Masuk sebagai:</div>
                        <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container-xl px-4">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                                        {{ Str::upper($setting->name) }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                @yield('content')
            </main>
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small text-uppercase text-muted">&copy; {{ date('Y') }} -
                            {{ Str::upper($setting->name) }}
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="/assets/js/litepicker.js"></script>
    <script src="/assets/backend/ckeditor5/build/ckeditor.js"></script>
    <script src="https://unpkg.com/cart-localstorage@1.1.4/dist/cart-localstorage.min.js" type="text/javascript"></script>
    <script src="/assets/dashboard/ckeditor5/build/ckeditor.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script src="/assets/js/custom.js"></script>
    @yield('script')
    <script>
        $(document).ready(function() {
            // $('select').attr('data-live-search', 'true');
            // $('select').selectpicker();

            $('#customTable').DataTable({
                "lengthChange": false,
                "paging": false,
                "bInfo": false
            });
        });
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('image-upload', ['_token' => csrf_token()]) }}", true);
                xhr.responseType = 'json';
            }

            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    resolve(response);
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            _sendRequest(file) {
                const data = new FormData();
                data.append('upload', file);
                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'alignment', 'indent', 'outdent', '|',
                    'bulletedList', 'numberedList', , '|', 'fontSize', 'fontColor', '|', 'blockQuote',
                    'horizontalLine', '|', 'insertTable', 'imageUpload', 'mediaEmbed', 'link', '|', 'removeFormat',
                    'code', '|', 'undo', 'redo'
                ],
                extraPlugins: [MyCustomUploadAdapterPlugin]
            }).then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('height', '300px', editor.editing.view.document.getRoot());
                });
                editor.config.define('mediaEmbed', {
                    providers: [{
                            name: 'youtube',
                            url: [
                                /^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)/,
                                /^(?:m\.)?youtube\.com\/v\/([\w-]+)/,
                                /^youtube\.com\/embed\/([\w-]+)/,
                                /^youtu\.be\/([\w-]+)/
                            ],
                            html: match => {
                                const id = match[1];
                                return (
                                    '<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 56.2493%;">' +
                                    `<iframe src="https://www.youtube.com/embed/${id}" ` +
                                    'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                                    'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>' +
                                    '</iframe>' +
                                    '</div>'
                                );
                            }
                        },
                        {
                            name: 'instagram',
                            url: /^instagram\.com\/p\/(\w+)/
                        },
                        {
                            name: 'twitter',
                            url: /^twitter\.com/
                        },
                        {
                            name: 'googleMaps',
                            url: /^google\.com\/maps/
                        },
                        {
                            name: 'facebook',
                            url: /^facebook\.com/
                        }
                    ]
                });
            });
    </script>
</body>

</html>
