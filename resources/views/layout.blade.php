<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Penjadwalan Pelayanan Teknik PLN | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #357ABD, #2C5FAD);
            height: 100vh;
            color: #fff;
            position: fixed;
            padding-top: 30px;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
            border-radius: 0.375rem;
            margin-bottom: 10px;
        }

        .sidebar .nav-link.active {
            background-color: #1E4C9A;
            border-radius: 0.375rem;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .card-box {
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 100px;
            height: auto;
        }

        .footer-text {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .nav-item {
            margin-bottom: 15px;
        }

        .btn-logout {
            margin-top: 20px;
            width: 100%;
            background-color: #357ABD;
            color: white;
            border-radius: 25px;
            padding: 12px;
        }

        .btn-logout:hover {
            background-color: #1E4C9A;
        }

        footer {
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <div class="sidebar d-flex flex-column p-3">
            <!-- Logo ITPLN -->
            <div class="logo-container">
                <img src="{{ asset('images/logo_pln.JPG') }}" alt="Logo ITPLN">
            </div>

            <h4 class="text-center text-white mb-4">Sistem Penjadwalan Pelayanan Teknik PLN</h4>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.index') }}" class="nav-link"><i class="fa-solid fa-user"></i> Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link"><i class="fa-solid fa-users"></i> Data User</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tugas.index') }}" class="nav-link"><i class="fa-solid fa-tasks"></i> Data Tugas</a>
                </li>
            </ul>

            <hr class="text-white">
            <div class="text-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
            </div>
        </div>

        <div class="content w-100">
            @yield('content')

            <footer class="text-center text-muted mt-5">
                <small>Copyright © Renata Yasmine Selomita 202231059 PLN {{ date('Y') }}</small>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
