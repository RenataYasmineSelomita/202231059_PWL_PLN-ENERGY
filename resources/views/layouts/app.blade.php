<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Penjadwalan Pelayanan Teknik PLN">
    <meta name="author" content="PLN Developer Team">

    <title>@yield('title', 'Sistem Penjadwalan Pelayanan Teknik PLN')</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        /* Custom global overrides */
        /* .sidebar-brand-icon img {  Tidak diperlukan lagi jika logo dihilangkan dari brand */
        /* width: 45px;
            height: auto;
            margin-right: 5px;  */
        /* } */
        .table th,
        .table td {
            vertical-align: middle !important;
        }

        .sidebar .nav-item .nav-link {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .sidebar #sidebarToggle {
            text-align: center;
        }

        /* Pastikan ikon brand default SB Admin 2 (jika digunakan) terlihat baik */
        .sidebar-brand-icon i {
            font-size: 1.75rem;
            /* Sesuaikan ukuran ikon jika perlu */
        }

        /* Custom styles for PLN colors */
        .bg-pln-blue {
            background-color: #003f7d;
        }

        .bg-pln-yellow {
            background-color: #ffb81c;
        }

        .text-pln-blue {
            color: #003f7d;
        }

        .text-pln-yellow {
            color: #ffb81c;
        }

        .border-left-pln-blue {
            border-left-color: #003f7d;
        }

        .border-left-pln-yellow {
            border-left-color: #ffb81c;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-pln-blue sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                {{-- GANTI IKON MENJADI PETIR --}}
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bolt text-pln-yellow"></i>
                    {{-- Ikon petir --}}
                </div>
                <div class="sidebar-brand-text mx-3 text-white">Penjadwalan</div>
                {{-- Teks Brand --}}
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt text-white"></i>
                    <span class="text-white">Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading text-white">
                Menu Utama
            </div>

            <li class="nav-item {{ request()->routeIs('user.index*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-users text-white"></i>
                    <span class="text-white">Manajemen Pegawai</span></a>
            </li>

            <li class="nav-item {{ request()->routeIs('tugas.index*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tugas.index') }}">
                    <i class="fas fa-fw fa-tasks text-white"></i>
                    <span class="text-white">Manajemen Tugas</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading text-white">
                Pengaturan
            </div>

            <li
                class="nav-item {{ request()->routeIs('profil.index*') || request()->routeIs('profil.edit*') || request()->routeIs('profil.reset-password*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profil.index') }}">
                    <i class="fas fa-fw fa-user-cog text-white"></i>
                    <span class="text-white">Profil</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline mt-3">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        @auth
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name ?? 'User' }}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ Auth::user()->profile_photo_url ?? asset('template/img/undraw_profile.svg') }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('profil.index') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-gray-600 small" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt fa-sm fa-fw mr-1"></i> Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-gray-600 small" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus fa-sm fa-fw mr-1"></i> Register
                                    </a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </nav>

                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span class="text-gray-600">Copyright © 202231059 Renata Yasmine Selomita ITPLN
                            {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Siap untuk Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Route::has('dashboard.store'))
        <div class="modal fade" id="addPengaduanModal" tabindex="-1" aria-labelledby="addPengaduanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPengaduanModalLabel">Tambah Pengaduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('dashboard.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="modal_pengaduan_nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="modal_pengaduan_nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_pengaduan_isi" class="form-label">Isi Pengaduan</label>
                                <textarea class="form-control" id="modal_pengaduan_isi" name="isi" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    @stack('scripts')

</body>

</html>
