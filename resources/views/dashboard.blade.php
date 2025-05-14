<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Penjadwalan Pelayanan Teknik PLN">
    <meta name="author" content="PLN">

    <title>Dashboard - Penjadwalan PLN</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* You can add minor custom styles here if needed */
        .table th,
        .table td {
            vertical-align: middle;
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
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bolt text-pln-yellow"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-white">Penjadwalan</div>
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

            <li class="nav-item {{ request()->routeIs('profil.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profil.index') }}">
                    <i class="fas fa-fw fa-user-cog text-white"></i>
                    <span class="text-white">Profil</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
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

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('template/img/undraw_profile.svg') }}">
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

                    </ul>

                </nav>
                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-pln-blue shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-pln-blue text-uppercase mb-1">
                                                Total Pegawai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ \App\Models\User::count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.index') }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-pln-yellow shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-pln-yellow text-uppercase mb-1">
                                                Total Tugas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ \App\Models\Tugas::count() }}</div> </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <a href="{{ route('tugas.index') }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>



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

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
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



        <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

        </body>

</html>
