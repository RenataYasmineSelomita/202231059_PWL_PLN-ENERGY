<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penjadwalan Pelayanan Teknik PLN | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #4A90E2, #357ABD); min-height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; padding: 20px 0; }
        .register-container { width: 100%; max-width: 500px; background-color: white; border-radius: 10px; padding: 30px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); max-height: 90vh; overflow-y: auto; }
        .register-container h4 { font-size: 24px; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .form-control { border-radius: 30px; padding: 10px 15px; margin-bottom: 10px; }
        .btn-primary { border-radius: 30px; padding: 10px; font-weight: bold; margin-top: 15px; }
        .alert { margin-bottom: 15px; }
        .text-muted a { text-decoration: none; color: #357ABD; }
        .text-muted a:hover { text-decoration: underline; }
        .logo-container { text-align: center; margin-bottom: 15px; }
        .logo-container img { width: 70px; height: auto; }
        .footer-text { text-align: center; font-size: 14px; margin-top: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { margin-bottom: 5px; font-weight: 500; }
        .text-danger { font-size: 0.875em; margin-top: .25rem; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo_pln.JPG') }}" alt="Logo PLN">
        </div>
        <h4>Register Sistem Penjadwalan</h4>

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

        <form method="POST" action="{{ route('register.submit') }}"> {/* Use named route */}
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" value="{{ old('username') }}" required>
                @error('username') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password (min. 6 karakter)" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="footer-text text-muted mt-3">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>