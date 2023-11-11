@extends('layouts.main')
@section('content')
    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title">
                <span><em></em></span>
                <h2 id="orderFood">Pesan Catering</h2>
                <p>Choosing one of the payment methods</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>Data Member & Alamat Kirim</h4>
                    <form action="/member/profile" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email" value="{{ auth()->user()->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan nama" value="{{ auth()->user()->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto Profil</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                                class="img-thumbnail img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                                    <textarea class="form-control" id="alamat_kirim" name="alamat_kirim" placeholder="Masukkan alamat kirim">{{ auth()->user()->member->alamat_kirim }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                                    <input type="text" class="form-control" id="nomor_wa" name="nomor_wa"
                                        placeholder="Masukkan nomor WhatsApp"
                                        value="{{ auth()->user()->member->nomor_wa }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 animated-element">
                    <a href="pay-with-card-online/" class="service-link">
                        <div class="box text-center">
                            <div class="icon d-flex align-items-end"><i class="icon icon-credit-card2"></i></div>
                            <h3 class="service-title">Pay Online</h3>
                            <p>and wait for delivery</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 animated-element">
                    <a href="pay-with-cash-on-delivery/" class="service-link">
                        <div class="box text-center">
                            <div class="icon d-flex align-items-end"><i class="icon icon-wallet"></i></div>
                            <h3 class="service-title">Pay with cash</h3>
                            <p>when food is arrived to you</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <div class="banner animated-element">
        <div class="container">
            <div class="content">
                <div class="mask">
                    <div class="textbox">
                        <small>Umi Tika Delivery</small>
                        <h2>Umi Tika Catering</h2>
                        <p>Pesan Catering sekarang! dari pada besok lapar.</p>
                        <a href="/catering" class="btn-1">Yuk Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            // Menangani perubahan pada input gambar
            $('#image').on('change', function() {
                readURL(this);
            });

            // Fungsi untuk memuat gambar yang dipilih
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Memperbarui sumber gambar
                        $('.img-thumbnail').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection
