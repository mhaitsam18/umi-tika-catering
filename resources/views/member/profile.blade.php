@extends('layouts.main')
@section('content')
    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title mb-3">
                <span><em></em></span>
                <h2 id="orderFood">Profile</h2>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Data Member & Alamat Kirim</h4>
                    <form action="/member/profile" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="member_id" id="member_id" value="{{ auth()->user()->member->id }}">
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukkan email"
                                        value="{{ old('email', auth()->user()->email) }}">
                                    @error('email')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukkan nama"
                                        value="{{ old('name', auth()->user()->name) }}">
                                    @error('name')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto Profil</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" value="{{ old('image', auth()->user()->image) }}">
                                    @error('image')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                                    <textarea class="form-control @error('alamat_kirim') is-invalid @enderror" id="alamat_kirim" name="alamat_kirim"
                                        placeholder="Masukkan alamat kirim">{{ old('alamat_kirim', auth()->user()->member->alamat_kirim) }}</textarea>
                                    @error('alamat_kirim')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                                    <input type="text" class="form-control @error('nomor_wa') is-invalid @enderror"
                                        id="nomor_wa" name="nomor_wa" placeholder="Masukkan nomor WhatsApp"
                                        value="{{ old('nomor_wa', auth()->user()->member->nomor_wa) }}">
                                    @error('nomor_wa')
                                        <div class="text-danger fs-6">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                            class="img-thumbnail img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 float-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->
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
