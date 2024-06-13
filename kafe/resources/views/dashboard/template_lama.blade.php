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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kafe Jogja</title>
    <!-- plugins:css -->
    <link rel="icon" type="image/x-icon" href="{{ '/storage/' . $setting->favicon }}" />
    <link rel="stylesheet" href="/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/assets/css/vertical-layout-light/style.css">
    <!-- endinject -->

    <!-- Trix Buat Text -->
    <link rel="stylesheet" type="text/css" href="/admin/dashboard/css/trix.css">
    <script type="text/javascript" src="/admin/dashboard/js/trix.js"></script>

    <!-- Ck Editor -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> -->


</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background-color:#024b8f;">
                <a class="navbar-brand brand-logo mr-5" href="/dashboard1"><img style="margin-left:30px;" width="180px;" src="/storage/{{ $setting->main_logo }}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="/dashboard1">
                    <img style="margin-left:5px;" width="150px" src="/storage/{{ $setting->favicon }}" alt="">
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color:#024b8f;">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">


                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="ti-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="ti-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown" style="color: #fff;">
                        <a class="nav-link dropdown-toggle" style="font-size: 15px;" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/images/profile.png' }}" />
                            {{ $user->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
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
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard1">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>

                        </a>
                    </li>
                    @if (in_array('users.index', $roles) ||
                    in_array('levels.index', $roles) ||
                    in_array('categories.index', $roles) ||
                    in_array('statusorders.index', $roles) ||
                    in_array('settings.index', $roles) ||
                    in_array('menus.index', $roles) ||
                    in_array('categoryconsultations.index', $roles) ||
                    in_array('statusconsultations.index', $roles))
                    <li class="nav-item">
                        <a class="{{ Request::is('dashboard/users*') ||
                            Request::is('dashboard/levels*') ||
                            Request::is('dashboard/categories*') ||
                            Request::is('dashboard/statusorders*') ||
                            Request::is('dashboard/categoryconsultations*') ||
                            Request::is('dashboard/statusconsultations*')
                                ? 'nav-link'
                                : 'nav-link collapsed' }}" data-toggle="collapse" href="#ui-basic" aria-expanded="{{ Request::is('dashboard/users*') ||
                                Request::is('dashboard/levels*') ||
                                Request::is('dashboard/categories*') ||
                                Request::is('dashboard/statusorders*') ||
                                Request::is('dashboard/categoryconsultations*') ||
                                Request::is('dashboard/statusconsultations*')
                                    ? 'true'
                                    : 'false' }}" aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Master Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="{{ Request::is('dashboard/users*') ||
                            Request::is('dashboard/levels*') ||
                            Request::is('dashboard/categories*') ||
                            Request::is('dashboard/statusorders*') ||
                            Request::is('dashboard/categoryconsultations*') ||
                            Request::is('dashboard/statusconsultations*')
                                ? 'collapse show'
                                : 'collapse' }}" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                @if (in_array('users.index', $roles))
                                <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">Data
                                        User</a></li>
                                @endif
                                @if (in_array('levels.index', $roles))
                                <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/levels*') ? 'active' : '' }}" href="/dashboard/levels">Level User</a>
                                </li>
                                @endif
                                @if (in_array('categories.index', $roles))
                                <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">Kategori Hidangan
                                    </a></li>
                                @endif
                                @if (in_array('statusorders.index', $roles))
                                <li class="nav-item"> <a class="nav-link  {{ Request::is('dashboard/statusorders*') ? 'active' : '' }}" href="/dashboard/statusorders">Status
                                        Order
                                    </a></li>
                                @endif
                                @if (in_array('categoryconsultations.index', $roles))
                                <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/categoryconsultations*') ? 'active' : '' }}" href="/dashboard/categoryconsultations">
                                        Kategori Konsultasi</a></li>
                                @endif
                                @if (in_array('statusconsultations.index', $roles))
                                <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/statusconsultations*') ? 'active' : '' }}" href="/dashboard/statusconsultations">
                                        Status Konsultasi</a></li>
                                @endif
                                <li class="nav-item"> <a class="nav-link" href="/dashboard/whatsapp/scan">Status & Scan<br>Whatsapp</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/dashboard/whatsapp/histories">Whatsapp History</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    {{-- @if (in_array('sliders.index', $roles) || in_array('menusnav.index', $roles))
                        <li class="nav-item">
                            <a class="{{ Request::is('dashboard/sliders*') || Request::is('dashboard/menusnav*') ? 'nav-link' : 'nav-link collapsed' }}"
                    data-toggle="collapse" href="#form-elements"
                    aria-expanded="{{ Request::is('dashboard/sliders*') || Request::is('dashboard/menusnav*') ? 'true' : 'false' }}"
                    aria-controls="form-elements">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Layout</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="{{ Request::is('dashboard/sliders*') || Request::is('dashboard/menusnav*') ? 'collapse show' : 'collapse' }}" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            @if (in_array('orders.index', $roles))
                            <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/sliders*') ? 'active' : '' }}" href="/dashboard/sliders">Sliders</a>
                            </li>
                            @endif
                            @if (in_array('menusnav.index', $roles))
                            <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/menusnav*') ? 'active' : '' }}" href="/dashboard/menusnav">Menu Nav
                                    Bar</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    </li>
                    @endif --}}
                    @if (in_array('menus.index', $roles))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/menus*') ? 'active' : '' }}" href="/dashboard/menus">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Menu</span>
                        </a>
                    </li>
                    @endif
                    @if (in_array('orders.index', $roles))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Order</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/konsultasi">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Konsultasi</span>
                        </a>
                    </li>
                    @if (in_array('consultationreplies.index', $roles))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/consultationreplies*') ? 'active' : '' }}" href="/dashboard/consultationreplies">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Balasan Konsultasi</span>
                        </a>
                    </li>
                    @endif
                    @if (in_array('settings.index', $roles))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/settings*') ? 'active' : '' }}" href="/dashboard/settings">
                            <i class="fa fa-sliders mr-3"></i>
                            <span class="menu-title">Pengaturan</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            {{ date('Y') }}.</span>

                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- SweetAlert -->
    @include('sweetalert::alert')

    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="/assets/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/template.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/assets/js/dashboard.js"></script>
    <script src="/assets/js/Chart.roundedBarCharts.js"></script>

    <!-- End custom js for this page-->

    {{-- js memunculkan subtotal  --}}
    <script src="/admin/dashboard/cart-localstorage/dist/cart-localstorage.min.js"></script>

    {{-- modal dialog level --}}
    <script src="/admin/dashboard/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    @yield('script')
    <!-- CK Editor -->
    <script src="/ckeditor5/build/ckeditor.js"></script>
    <!-- <script>
        $(document).ready(function() {
            CKEDITOR.config.allowedContent = true;
            CKEDITOR.replace('texteditor', {
                height: 350,
            })
        });
    </script> -->



    <!-- <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.querySelectorAll('oembed[url]').forEach(element => {

            const anchor = document.createElement('a');

            anchor.setAttribute('href', element.getAttribute('url'));
            anchor.className = 'embedly-card';

            element.appendChild(anchor);
        });
    </script> -->

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

    @yield('script')

</body>

</html>