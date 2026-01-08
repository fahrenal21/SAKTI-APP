<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SAKTI | Login</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logo-sakti.png') }}" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Auth CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    @include('sweetalert::alert')
    
    <div class="auth-container">
        <!-- Left Panel - Branding -->
        <div class="branding-panel">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            
            <div class="branding-content">
                <div class="logo-wrapper">
                    <img src="{{ asset('img/logo-sakti.png') }}" alt="SAKTI Logo">
                </div>
                <h1 class="brand-title">SAKTI</h1>
                <p class="brand-tagline">Sistem Administrasi Kepegawaian Terintegrasi</p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="form-panel">
            <div class="auth-form-wrapper">
                <div class="form-header">
                    <h2>Selamat Datang!</h2>
                    <p>Silakan masuk ke akun Anda untuk melanjutkan</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}" id="loginForm">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input id="email" 
                                   type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus
                                   placeholder="Masukkan email Anda">
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="Masukkan password Anda">
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Ingat saya</label>
                        </div>
                        <a class="forgot-link" href="{{ route('forget-password.getEmail') }}">
                            Lupa password?
                        </a>
                    </div>

                    <button type="submit" class="btn-auth" id="loginBtn">
                        Masuk
                    </button>
                </form>

                <p class="copyright">Copyright &copy; SAKTI {{ date('Y') }}. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function() {
            document.getElementById('loginBtn').classList.add('loading');
            document.getElementById('loginBtn').disabled = true;
        });
    </script>
</body>
</html>