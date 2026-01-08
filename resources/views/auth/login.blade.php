<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - SAKTI</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            background: #f8fafc;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left Panel - Branding */
        .branding-panel {
            flex: 0 0 45%;
            background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #00796b 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .branding-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 15s ease-in-out infinite;
        }

        .branding-panel::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -30%;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle, rgba(0,188,212,0.15) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, 30px) rotate(5deg); }
        }

        .branding-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .logo-wrapper {
            margin-bottom: 30px;
        }

        .logo-wrapper img {
            width: 120px;
            height: auto;
            filter: brightness(0) invert(1);
        }

        .brand-title {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: 8px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .brand-tagline {
            font-size: 0.95rem;
            font-weight: 300;
            opacity: 0.9;
            max-width: 300px;
            line-height: 1.6;
        }

        /* Decorative shapes */
        .shape {
            position: absolute;
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            z-index: 0;
        }

        .shape-1 {
            width: 100px;
            height: 60px;
            top: 15%;
            left: 10%;
            transform: rotate(-15deg);
        }

        .shape-2 {
            width: 80px;
            height: 50px;
            bottom: 20%;
            right: 15%;
            transform: rotate(10deg);
        }

        .shape-3 {
            width: 60px;
            height: 40px;
            top: 40%;
            right: 10%;
            transform: rotate(-5deg);
            border-color: rgba(0,188,212,0.3);
        }

        /* Right Panel - Form */
        .form-panel {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: #ffffff;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .form-header {
            margin-bottom: 35px;
        }

        .form-header h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1a237e;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            width: 18px;
            height: 18px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            font-size: 0.95rem;
            font-family: inherit;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #1a237e;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(26, 35, 126, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #1a237e;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 6px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #1a237e;
            cursor: pointer;
        }

        .checkbox-wrapper label {
            font-size: 0.875rem;
            color: #4b5563;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.875rem;
            color: #00796b;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #004d40;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px 24px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            color: #ffffff;
            background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #00796b 100%);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .branding-panel {
                flex: 0 0 40%;
            }

            .brand-title {
                font-size: 2.5rem;
                letter-spacing: 6px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .branding-panel {
                flex: 0 0 auto;
                min-height: 200px;
                padding: 30px 20px;
            }

            .logo-wrapper img {
                width: 80px;
            }

            .brand-title {
                font-size: 2rem;
                letter-spacing: 4px;
                margin-bottom: 10px;
            }

            .brand-tagline {
                font-size: 0.85rem;
            }

            .form-panel {
                padding: 30px 20px;
            }

            .shape {
                display: none;
            }
        }

        /* Loading animation */
        .btn-login.loading {
            color: transparent;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
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
                <p class="brand-tagline">Sistem Administrasi Kepegawaian Terpadu Integrated</p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="form-panel">
            <div class="login-form-wrapper">
                <div class="form-header">
                    <h2>Selamat Datang!</h2>
                    <p>Silakan masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}" id="loginForm">
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
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        Masuk
                    </button>
                </form>
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

        // Add loading state on form submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            document.getElementById('loginBtn').classList.add('loading');
            document.getElementById('loginBtn').disabled = true;
        });
    </script>
</body>
</html>
