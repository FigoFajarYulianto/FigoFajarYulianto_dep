{{--  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
    </ul>
</nav>  --}}




<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item flex-row ml-md-0 ml-auto pl-3">
            <li class="nav-item align-self-center search-animated">
                <i class="las la-search toggle-search"></i>
                <form class="form-inline search-full form-inline search" action="pages_search_result.html" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto"
                            placeholder="Search here">
                    </div>
                </form>
            </li>
            <li class="nav-item dropdown megamenu-dropdown d-none d-lg-flex">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle d-flex align-center text-primary"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Other Links <i class="las la-angle-down font-11 ml-1"></i>
                </a>
                <div class="dropdown-menu megamenu">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-17 mt-0">Applications</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li class="font-15 mb-1"><a href="apps_ecommerce.html">Ecommerce</a></li>
                                        <li class="font-15 mb-1"><a href="apps_chat.html">Chat</a></li>
                                        <li class="font-15 mb-1"><a href="apps_mail.html">Email</a></li>
                                        <li class="font-15 mb-1"><a href="apps_file_manager.html">File Manager</a>
                                        </li>
                                        <li class="font-15 mb-1"><a href="apps_calendar.html">Calender</a></li>
                                        <li class="font-15 mb-1"><a href="apps_notes.html">Notes</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="font-17 mt-0">Extra Pages</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li class="font-15 mb-1"><a href="pages_contact_us.html">Contact Us</a>
                                        </li>
                                        <li class="font-15 mb-1"><a href="pages_faq.html">FAQ</a></li>
                                        <li class="font-15 mb-1"><a href="pages_helpdesk.html">Helpdesk</a></li>
                                        <li class="font-15 mb-1"><a href="pages_pricing_2.html">Pricing</a></li>
                                        <li class="font-15 mb-1"><a href="pages_search_result.html">Search
                                                Result</a></li>
                                        <li class="font-15 mb-1"><a href="pages_privacy_policy.html">Privacy
                                                Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-lg-1">
                                <div class="row no-gutters">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-1.jpg" alt="slack">
                                            <span>Cube</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-2.jpg" alt="Github">
                                            <span>HTech</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-3.jpg" alt="dribbble">
                                            <span>Inovation</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-4.jpg" alt="bitbucket">
                                            <span>Circle</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-5.jpg" alt="dropbox">
                                            <span>Techno</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-6.jpg" alt="G Suite">
                                            <span>T Logy</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item dropdown fullscreen-dropdown d-none d-lg-flex">
                <a class="nav-link full-screen-mode" href="javascript:void(0);">
                    <i class="las la-compress" id="fullScreenIcon"></i>
                </a>
            </li>
            <li class="nav-item dropdown language-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="las la-language"></i>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/usa-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;English</span>
                    </a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/spain-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Spanish</span>
                    </a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/france-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;French</span>
                    </a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/saudi-arabia-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Arabic</span>
                    </a>
                </div>
            </li>
        </ul>
        <ul class="navbar-item flex-row">
            <li class="nav-item dropdown header-setting">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle rightbarCollapse"
                    data-placement="bottom">
                    <i class="las la-sliders-h"></i>
                </a>
            </li>
        </ul>
    </header>
</div>
