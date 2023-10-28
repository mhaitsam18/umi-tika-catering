@extends('layouts.auth-main')
@section('content')
    <!-- Hero -->
    {{-- <div class="hero-home bg-mockup hero-bottom-border">
        <div class="content">
            <h1 class="animated-element">Silahkan Login</h1>
            <p class="animated-element">Food order wizard with online payment.</p>
            <a href="pay-with-card-online/" class="btn-1 medium animated-element">Get Started</a>
            <a href="#orderFood" class="mouse-frame nice-scroll">
                <div class="mouse"></div>
            </a>
        </div>
    </div> --}}
    <!-- Hero End -->

    <!-- Services -->
    <div class="services mt-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <style>
                            .custom-bg {
                                background-image: url({{ asset('storage/menu/menu-default.jpg') }});
                                background-size: cover;
                                background-position: center;
                                width: 100%;
                                /* Menggunakan 100% untuk lebar agar menjadi full width */
                                height: 50vh;
                                /* Menggunakan 100vh untuk tinggi agar mengisi tinggi viewport */
                            }
                        </style>
                        <div class="col-lg-6 custom-bg">

                        </div>
                        <div class="col-lg-6">
                            <form action="/login" method="post">
                                <h3 class="mb-4">Silahkan Login</h3>
                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger mb-3 " role="alert">
                                        {{ session('loginError') }}
                                    </div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success mb-3 " role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @csrf
                                <div class="mb-3 ">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="email">
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 ">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" autocomplete="current-password"
                                        placeholder="Password">
                                    @error('password')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <button type="submit" class="btn-2 float-right">Login</button>
                                    {{-- <button type="button"
                                        class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                        <i class="btn-icon-prepend" data-feather="twitter"></i>
                                        Login with twitter
                                    </button> --}}
                                </div>
                                <a href="/register" class="d-block mt-3 text-muted">Belum punya akun? Daftar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    {{-- <div class="banner animated-element">
        <div class="container">
            <div class="content">
                <div class="mask">
                    <div class="textbox">
                        <small>Umi Tika Delivery</small>
                        <h2>Umi Tika Catering</h2>
                        <p>Pesan Catering sekarang! dari pada lapar besok.</p>
                        <a href="faq.html" class="btn-1">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
