{{--  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link navbar-primary">
        <img src="{{ $pengaturan->logo != null ? asset('storage/' . $pengaturan->logo) : '/assets/img/logo.svg' }}"
            alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text text-light">{{ $pengaturan->nama_institusi }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/img/user.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">
                    DATA MASTER
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelas.index') }}"
                        class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kelas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rombel.index') }}"
                        class="nav-link {{ request()->routeIs('rombel.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Rombel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.index') }}"
                        class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Siswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mapel.index') }}"
                        class="nav-link {{ request()->routeIs('mapel.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Mata Pelajaran
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    BANK SOAL
                </li>
                <li class="nav-item">
                    <a href="{{ route('paket-soal.index') }}"
                        class="nav-link {{ request()->routeIs('paket-soal.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Paket Soal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('soal.index') }}"
                        class="nav-link {{ request()->routeIs('soal.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Daftar Soal
                        </p>
                    </a>
                </li>



                <li class="nav-header">
                    UJIAN
                </li>
                <li class="nav-item">
                    <a href="{{ route('ujian.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Daftar Ujian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ujian.riwayat') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Riwayat Ujian</p>
                    </a>
                </li>



                <li class="nav-header">
                    SPK
                </li>
                <li class="nav-item">
                    <a href="/admin/kandidats"
                        class="nav-link {{ request()->routeIs('kandidats.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kandidat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kriterias"
                        class="nav-link {{ request()->routeIs('kriterias.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kriteria
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/nilais" class="nav-link {{ request()->routeIs('nilais.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Nilai
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="/admin/laporans"
                        class="nav-link {{ request()->routeIs('laporans.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan SPK
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pengaturan Ujian
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    MANAJEMEN APLIKASI
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengaturan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pengaturan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>  --}}



<!--  Sidebar Starts  -->
<div class="sidebar-wrapper sidebar-theme">
    <div>
        <div class="sc-container">
        </div>
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <i class="las la-angle-left"></i>
        </a>
    </div>
    <nav id="sidebar">
        <ul class="navbar-item theme-brand flex-row  text-center">
            {{--  <li class="nav-item theme-logo" style="width: 100%;">
                <a href="{{ route('admin.index') }}">
                    <h5>{{ $pengaturan->nama_institusi }}</h5>
                </a>
                <img src="/storage/{{ $pengaturan->logo }}" alt="logo">
                </a>
            </li>  --}}

            <li class="nav-item theme-text">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    {{ $pengaturan->nama_institusi }}</a>
            </li>
        </ul>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-home"></i>
                        <span>Master Data</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled collapse show" id="dashboard" data-parent="#accordionExample">
                    <li class="">
                        <a data-active="" href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"> User </a>
                    </li>
                    <li class="">
                        <a data-active="" href="{{ route('kelas.index') }}"
                            class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}"> Kelas </a>
                    </li>
                    <li>
                        <a href="{{ route('rombel.index') }}"
                            class="nav-link {{ request()->routeIs('rombel.index') ? 'active' : '' }}"> Rombel </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.index') }}"
                            class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}"> Calon Kandidat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mapel.index') }}"
                            class="nav-link {{ request()->routeIs('mapel.index') ? 'active' : '' }}"> Mapel Ujian </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="lab la-medapps"></i>
                        <span>Manajemen Soal</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    <li class="active">
                        <a href="{{ route('paket-soal.index') }}"
                            class="nav-link {{ request()->routeIs('paket-soal.index') ? 'active' : '' }}"> Paket Soal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('soal.index') }}"
                            class="nav-link {{ request()->routeIs('soal.index') ? 'active' : '' }}"> Soal </a>
                    </li>

                </ul>
            </li>

            <li class="menu-title"></li>
            <li class="menu">
                <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-drafting-compass"></i>
                        <span>Manajemen Ujian</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('ujian.index') }}">Daftar Ujian</a>
                    </li>
                    <li>
                        <a href="{{ route('ujian.riwayat') }}">Riwayat Ujian</a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="lab la-elementor"></i>
                        <span>SPK</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">
                    <li>
                        <a href="/admin/kandidats"
                            class="nav-link {{ request()->routeIs('kandidats.index') ? 'active' : '' }}"> Kandidat </a>
                    </li>
                    <li>
                        <a href="/admin/kriterias"
                            class="nav-link {{ request()->routeIs('kriterias.index') ? 'active' : '' }}"> Kriteria </a>
                    </li>
                    <li>
                        <a href="/admin/nilais"
                            class="nav-link {{ request()->routeIs('nilais.index') ? 'active' : '' }}"> Nilai </a>
                    </li>
                    <li>
                        <a href="/admin/rekaps"
                            class="nav-link {{ request()->routeIs('rekaps.index') ? 'active' : '' }}"> Rekap </a>
                    </li>
                    <li>
                        <a href="/admin/laporans"
                            class="nav-link {{ request()->routeIs('laporans.index') ? 'active' : '' }}">
                            Laporan </a>
                    </li>
                    <li>
                        <a href="/admin/riwayats"
                            class="nav-link {{ request()->routeIs('riwayats.index') ? 'active' : '' }}">
                            Terpilih </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="{{ route('pengaturan.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-desktop"></i>
                        <span>Pengaturan</span>
                    </div>
                </a>
            </li>

        </ul>
        <ul class="sidebar-bottom-options">

            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="las la-circle"></i>

                </a>

            </li>

        </ul>
    </nav>
</div>
<!--  Sidebar Ends  -->
