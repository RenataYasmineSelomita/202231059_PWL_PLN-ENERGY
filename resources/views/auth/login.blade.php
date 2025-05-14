<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penjadwalan Pelayanan Teknik PLN | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #4A90E2, #357ABD); height: 100vh; display: flex; justify-content: center; align-items: center; margin:0; }
        .login-container { width: 100%; max-width: 450px; background-color: white; border-radius: 20px; padding: 40px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); }
        .login-container h4 { font-size: 24px; margin-bottom: 30px; text-align: center; font-weight: bold; }
        .form-control { border-radius: 30px; padding: 12px 20px; margin-bottom: 15px; }
        .btn-primary { border-radius: 30px; padding: 12px; font-weight: bold; margin-bottom: 15px; }
        .alert { margin-bottom: 20px; }
        .text-muted a { text-decoration: none; color: #357ABD; }
        .text-muted a:hover { text-decoration: underline; }
        .logo-container { text-align: center; margin-bottom: 20px; }
        .logo-container img { width: 80px; height: auto; }
        .footer-text { text-align: center; font-size: 14px; margin-top: 20px; }
        .form-group { margin-bottom: 20px; }
        @media (max-width: 768px) { .login-container { padding: 30px 20px; } }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo_pln.JPG') }}" alt="Logo PLN">
        </div>
        <h4>Sistem Penjadwalan Pelayanan Teknik PLN</h4>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username atau Email" value="{{ old('username') }}" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="footer-text text-muted mt-3">
            Belum memiliki akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>