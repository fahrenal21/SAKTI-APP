@extends('login.base')

@section('title', 'SAKTI | Login')

@section('content')
{{-- 1. TAMBAHKAN 3 CLASS INI untuk membuat container utama menjadi flexbox --}}
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto d-flex flex-column min-vh-100">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row">
                        {{-- Ganti 'img/logo.png' dengan path logo Anda di folder public --}}
                        <img src="{{ asset('img/logo.png') }}" class="logo">
                    </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                        {{-- Ganti 'img/vector.png' dengan path gambar Anda di folder public --}}
                        <img src="{{ asset('img/vector.png') }}" class="image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    
                    {{-- Form Login Laravel --}}
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        {{-- Input Email --}}
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                            <input class="mb-4" type="email" name="email" placeholder="Enter a valid email address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>

                        {{-- Input Password --}}
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                            <input type="password" name="password" placeholder="Enter password" required autocomplete="current-password">
                        </div>
                        
                        <div class="row px-3 mb-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input id="chk1" type="checkbox" name="remember" class="custom-control-input"> 
                                <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                            </div>
                            {{-- Link Lupa Password --}}
                            <a href="{{ route('forget-password.getEmail') }}" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                        </div>

                        {{-- Tombol Sign In --}}
                        <div class="row mb-3 px-3">
                            <button type="submit" class="btn btn-blue text-center">Login</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    {{-- 2. TAMBAHKAN CLASS 'mt-auto' PADA DIV FOOTER INI --}}
    <div class="mt-auto">
        <div class="row px-3 justify-content-center">
            <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; SAKTI {{ date('Y') }}. All rights reserved.</small>
        </div>
    </div>
</div>
@endsection