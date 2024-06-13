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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title_bar }}</title>
    <link rel="icon" type="image/x-icon" href="/storage/{{ $setting->favicon }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="/assets/css/vertical-layout-light/style.css">
    <link rel="stylesheet" type="text/css" href="/admin/dashboard/css/trix.css">
    <script type="text/javascript" src="/admin/dashboard/js/trix.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        type="text/css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" type="text/css" />
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
                style="background-color:#024b8f;">
                <a class="navbar-brand brand-logo mr-5" href="/dashboard1"><img style="margin-left:30px;" width="180px;"
                        src="/storage/{{ $setting->main_logo }}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="/dashboard1">
                    <img style="margin-left:5px;" width="150px" src="/storage/{{ $setting->favicon }}" alt="">
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end"
                style="background-color:#024b8f;">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown" style="color: #fff;">
                        <a class="nav-link dropdown-toggle" style="font-size: 15px;" href="#"
                            data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/images/profile.png' }}" />
                            {{ $user->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="/dashboard/profile">
                                <i class="ti-settings text-primary"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="/" target="_blank">
                                <i class="ti-arrow-right text-primary"></i>
                                Ke Website
                            </a>
                            <a class="dropdown-item" href="/auth/logout">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            {{-- <div class="theme-setting-wrapper">
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div> --}}

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard1">
                            <i class="fa fa-tachometer icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>

                        </a>
                    </li>
                    @if (in_array('users.index', $roles) ||
                        in_array('levels.index', $roles) ||
                        in_array('categories.index', $roles) ||
                        in_array('kategories.index', $roles) ||
                        in_array('statusorders.index', $roles) ||
                        in_array('programs.index', $roles) ||
                        in_array('categoriperaturans.index', $roles) ||
                        in_array('settings.index', $roles) ||
                        in_array('menus.index', $roles) ||
                        in_array('categoryconsultations.index', $roles) ||
                        in_array('kecamatans.index', $roles) ||
                        in_array('desas.index', $roles) ||
                        in_array('statusconsultations.index', $roles))
                        <li class="nav-item">
                            <a class="{{ Request::is('dashboard/users*') ||
                            Request::is('dashboard/levels*') ||
                            Request::is('dashboard/categories*') ||
                            Request::is('dashboard/programs*') ||
                            Request::is('dashboard/categoriperaturans*') ||
                            Request::is('dashboard/kategories*') ||
                            Request::is('dashboard/statusorders*') ||
                            Request::is('dashboard/kecamatans*') ||
                            Request::is('dashboard/desas*') ||
                            Request::is('dashboard/categoryconsultations*') ||
                            Request::is('dashboard/statusconsultations*')
                                ? 'nav-link'
                                : 'nav-link collapsed' }}"
                                data-toggle="collapse" href="#ui-basic"
                                aria-expanded="{{ Request::is('dashboard/users*') ||
                                Request::is('dashboard/levels*') ||
                                Request::is('dashboard/categories*') ||
                                Request::is('dashboard/programs*') ||
                                Request::is('dashboard/categoriperaturans*') ||
                                Request::is('dashboard/kategories*') ||
                                Request::is('dashboard/statusorders*') ||
                                Request::is('dashboard/kecamatans*') ||
                                Request::is('dashboard/desas*') ||
                                Request::is('dashboard/categoryconsultations*') ||
                                Request::is('dashboard/statusconsultations*')
                                    ? 'true'
                                    : 'false' }}"
                                aria-controls="ui-basic">
                                <i class="fa fa-database menu-icon icon-grid"></i>
                                <span class="menu-title">Master Data</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="{{ Request::is('dashboard/users*') ||
                            Request::is('dashboard/levels*') ||
                            Request::is('dashboard/categories*') ||
                            Request::is('dashboard/programs*') ||
                            Request::is('dashboard/kategories*') ||
                            Request::is('dashboard/categoriperaturans*') ||
                            Request::is('dashboard/statusorders*') ||
                            Request::is('dashboard/kecamatans*') ||
                            Request::is('dashboard/desas*') ||
                            Request::is('dashboard/categoryconsultations*') ||
                            Request::is('dashboard/statusconsultations*')
                                ? 'collapse show'
                                : 'collapse' }}"
                                id="ui-basic">
                                <ul class="nav flex-column sub-menu" style="padding: 0.25rem 0 0 1.5rem !important;">
                                    @if (in_array('users.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}"
                                                href="/dashboard/users">Data
                                                User</a></li>
                                    @endif
                                    @if (in_array('levels.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/levels*') ? 'active' : '' }}"
                                                href="/dashboard/levels">Data Level</a>
                                        </li>
                                    @endif

                                    @if (in_array('kecamatans.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/kecamatans*') ? 'active' : '' }}"
                                                href="/dashboard/kecamatans">Data Kecamatan</a>
                                        </li>
                                    @endif
                                    @if (in_array('desas.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/desas*') ? 'active' : '' }}"
                                                href="/dashboard/desas">Data Desa</a>
                                        </li>
                                    @endif
                                    @if (in_array('IRBAN.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/irbans*') ? 'active' : '' }}"
                                                href="/dashboard/irbans">Data IRBAN</a>
                                        </li>
                                    @endif
                                    @if (in_array('wilayah_IRBAN.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/irbanwilayahs*') ? 'active' : '' }}"
                                                href="/dashboard/irbanwilayahs">Data Wilayah IRBAN</a>
                                        </li>
                                    @endif
                                    @if (in_array('categories.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}"
                                                href="/dashboard/categories">Kategori
                                                Berita</a></li>
                                    @endif
                                    @if (in_array('programs.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/programs*') ? 'active' : '' }}"
                                                href="/dashboard/programs">Kategori
                                                Menu</a></li>
                                    @endif
                                    @if (in_array('categoriperaturans.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/categoriperaturans*') ? 'active' : '' }}"
                                                href="/dashboard/categoriperaturans">Kategori
                                                Peraturan</a></li>
                                    @endif
                                    @if (in_array('kategories.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/kategories*') ? 'active' : '' }}"
                                                href="/dashboard/kategories">Status</a></li>
                                    @endif
                                    @if (in_array('whatsapp.index', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/whatsapp/histories*') ? 'active' : '' }}"
                                                href="/dashboard/whatsapp/histories">Histori WhatsApp</a></li>
                                    @endif
                                    @if (in_array('whatsapp.scan', $roles))
                                        <li class="nav-item"> <a
                                                class="nav-link {{ Request::is('dashboard/whatsapp/scan*') ? 'active' : '' }}"
                                                href="/dashboard/whatsapp/scan">Scan WhatsApp</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (in_array('sliders.index', $roles) ||
                        in_array('menus.index', $roles) ||
                        in_array('sections.index', $roles) ||
                        in_array('links.index', $roles) ||
                        in_array('abouts.index', $roles) ||
                        in_array('services.index', $roles) ||
                        in_array('callToActions.index', $roles))
                        <li class="nav-item">
                            <a class="{{ Request::is('dashboard/sliders*') ||
                            Request::is('dashboard/menus*') ||
                            Request::is('dashboard/sections*') ||
                            Request::is('dashboard/links*') ||
                            Request::is('dashboard/abouts*') ||
                            Request::is('dashboard/services*') ||
                            Request::is('dashboard/callToActions*')
                                ? 'nav-link'
                                : 'nav-link collapsed' }}"
                                data-toggle="collapse" href="#form-elements"
                                aria-expanded="{{ Request::is('dashboard/sliders*') ||
                                Request::is('dashboard/menus*') ||
                                Request::is('dashboard/sections*') ||
                                Request::is('dashboard/links*') ||
                                Request::is('dashboard/abouts*') ||
                                Request::is('dashboard/services*') ||
                                Request::is('dashboard/callToActions*')
                                    ? 'true'
                                    : 'false' }}"
                                aria-controls="form-elements">
                                <i class="fa fa-th-large menu-icon icon-grid"></i>
                                <span class="menu-title">Layout</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="form-elements">
                                <ul class="nav flex-column sub-menu" style="padding: 0.25rem 0 0 1.5rem !important;">
                                    @if (in_array('sliders.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/sliders*') ? 'active' : '' }}"
                                                href="/dashboard/sliders">Slider</a>
                                        </li>
                                    @endif
                                    @if (in_array('menus.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/menus*') ? 'active' : '' }}"
                                                href="/dashboard/menus">Menu</a>
                                        </li>
                                    @endif
                                    @if (in_array('sections.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/sections*') ? 'active' : '' }}"
                                                href="/dashboard/sections">Section</a>
                                        </li>
                                    @endif
                                    @if (in_array('links.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/links*') ? 'active' : '' }}"
                                                href="/dashboard/links">Link
                                                Terkait</a>
                                        </li>
                                    @endif
                                    @if (in_array('abouts.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/abouts*') ? 'active' : '' }}"
                                                href="/dashboard/abouts">Tentang Kami</a>
                                        </li>
                                    @endif
                                    @if (in_array('services.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/services*') ? 'active' : '' }}"
                                                href="/dashboard/services">Layanan</a>
                                        </li>
                                    @endif
                                    @if (in_array('callToActions.index', $roles))
                                        <li class="nav-item"><a
                                                class="nav-link {{ Request::is('dashboard/callToActions*') ? 'active' : '' }}"
                                                href="/dashboard/callToActions">Call
                                                To
                                                Action</a></li>
                                    @endif
                                </ul>
                            </div>

                        </li>
                    @endif

                    @if (in_array('pages.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/pages*') ? 'active' : '' }}"
                                href="/dashboard/pages">
                                <i class="fa fa-file-text icon-grid menu-icon"></i>
                                <span class="menu-title">Halaman</span>
                            </a>
                        </li>
                    @endif
                    @if (in_array('posts.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}"
                                href="/dashboard/posts">
                                <i class="fa fa-file icon-grid menu-icon"></i>
                                <span class="menu-title">Berita</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('testimonials.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/testimonials*') ? 'active' : '' }}"
                                href="/dashboard/testimonials">
                                <i class="fa fa-star icon-grid menu-icon"></i>
                                <span class="menu-title">SKM</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('staffs.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/staffs*') ? 'active' : '' }}"
                                href="/dashboard/staffs">
                                <i class="fa fa-users icon-grid menu-icon"></i>
                                <span class="menu-title">Staff</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('regulasis.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/regulasis*') ? 'active' : '' }}"
                                href="/dashboard/regulasis">
                                <i class="fa fa-registered icon-grid menu-icon"></i>
                                <span class="menu-title">Regulasi</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('kopi-j.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/kopijs*') ? 'active' : '' }}"
                                href="/dashboard/kopijs">
                                <i class="fa fa-envelope icon-grid menu-icon"></i>
                                <span class="menu-title">KOPI-J</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('front_desk.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/letters*') ? 'active' : '' }}"
                                href="/dashboard/letters">
                                <i class="fa fa-envelope icon-grid menu-icon"></i>
                                <span class="menu-title">Front Desk</span>
                            </a>
                        </li>
                    @endif

                    @if (in_array('settings.index', $roles))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/settings*') ? 'active' : '' }}"
                                href="/dashboard/settings">
                                <i class="fa fa-cogs icon-grid menu-icon"></i>
                                <span class="menu-title">Pengaturan Web</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/assets/js/dataTables.select.min.js"></script>
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/template.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <script src="/assets/js/dashboard.js"></script>
    <script src="/assets/js/Chart.roundedBarCharts.js"></script>
    <script src="/admin/dashboard/js/custom.js"></script>
    <script src="/ckeditor5/build/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>

    @yield('script')

    <script>
        document.querySelectorAll('oembed[url]').forEach(element => {

            const anchor = document.createElement('a');

            anchor.setAttribute('href', element.getAttribute('url'));
            anchor.className = 'embedly-card';

            element.appendChild(anchor);
        });
    </script>

    <script>
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
                    writer.setStyle('height', '500px', editor.editing.view.document.getRoot());
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
