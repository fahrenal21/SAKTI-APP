<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SAKTI | Lupa Password</title>
    
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

        <!-- Right Panel - Forgot Password Form -->
        <div class="form-panel">
            <div class="auth-form-wrapper">
                <div class="form-header">
                    <h2>Lupa Password?</h2>
                    <p>Masukkan email Anda dan kami akan mengirimkan link untuk mereset password</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('forget-password.postEmail') }}" id="forgotForm">
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

                    <button type="submit" class="btn-auth" id="submitBtn">
                        Kirim Link Reset Password
                    </button>
                </form>

                <a href="{{ route('login') }}" class="btn-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali ke halaman login
                </a>

                <p class="copyright">Copyright &copy; SAKTI {{ date('Y') }}. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('forgotForm').addEventListener('submit', function() {
            document.getElementById('submitBtn').classList.add('loading');
            document.getElementById('submitBtn').disabled = true;
        });
    </script>
</body>
</html>
