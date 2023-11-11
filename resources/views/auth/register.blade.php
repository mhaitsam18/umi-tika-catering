@extends('layouts.auth-main')
@section('content')
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
                            <form action="/register" method="post">
                                <h3 class="mb-4">Daftar Akun</h3>
                                @if (session()->has('success'))
                                    <div class="alert alert-success mb-3" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Nama Lengkap"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" autocomplete="new-password" placeholder="Password">
                                    @error('password')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                        placeholder="Konfirmasi Password">
                                    @error('password_confirmation')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <button type="submit" class="btn-2 float-right">Daftar</button>
                                </div>
                                <a href="/login" class="d-block mt-3 text-muted">Sudah punya akun? Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
