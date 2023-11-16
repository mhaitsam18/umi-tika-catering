@extends('layouts.main')
@section('content')
    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title mb-3">
                <span><em></em></span>
                <h2 id="orderFood">Keranjang</h2>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Data Keranjang</h4>
                    <div class="container mt-5 mb-1" id="keranjang">
                        <h2>Isi Keranjang</h2>

                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>paket</th>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('cart') && count(session('cart')) > 0)
                                    @php
                                        $totalHarga = 0;
                                    @endphp
                                    @foreach (session('cart') as $item)
                                        <tr>
                                            <td>{{ $item['tanggal'] }}</td>
                                            <td>{{ $item['paket'] . ' | ' . $item['waktu_makan'] }}</td>
                                            <td>{{ $item['menu_name'] }}</td>
                                            <td>
                                                <!-- Tombol Kurang -->
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="updateQuantity({{ $item['menu_id'] }}, -1)">-</button>
                                                {{ $item['quantity'] }}
                                                <!-- Tombol Tambah -->
                                                <button class="btn btn-success btn-sm"
                                                    onclick="updateQuantity({{ $item['menu_id'] }}, 1)">+</button>
                                            </td>
                                            <td>Rp.{{ number_format($item['price'], 2, ',', '.') }}</td>
                                            <td>Rp.{{ number_format($item['quantity'] * $item['price'], 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <!-- Tombol Hapus -->
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="removeItem({{ $item['menu_id'] }})">Hapus</button>
                                            </td>
                                        </tr>
                                        @php
                                            $totalHarga += $item['quantity'] * $item['price'];
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if (session()->has('cart') && count(session('cart')) > 0)
                            <!-- Gunakan offset untuk membuat kolom kosong di sisi kiri -->
                            <!-- Form Checkout -->
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <h4>Kontak dan Alamat Kirim</h4>
                                    <form action="/member/member" method="post" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="member_id" id="member_id"
                                            value="{{ auth()->user()->member->id }}">
                                        <div class="form-group">
                                            <label for="alamat_kirim">Alamat Kirim</label>
                                            <textarea class="form-control @error('alamat_kirim') is-invalid @enderror" id="alamat_kirim" name="alamat_kirim"
                                                placeholder="Masukkan alamat kirim">{{ old('alamat_kirim', auth()->user()->member->alamat_kirim) }}</textarea>
                                            @error('alamat_kirim')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_wa">Nomor WhatsApp</label>
                                            <input type="text"
                                                class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa"
                                                name="nomor_wa" placeholder="Masukkan nomor WhatsApp"
                                                value="{{ old('nomor_wa', auth()->user()->member->nomor_wa) }}">
                                            @error('nomor_wa')
                                                <div class="text-danger fs-6">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <h4>Tata Cara Pembayaran</h4>
                                    <p>
                                        Pembayaran ke rekening :
                                        <br> <b>Bank mandiri a/n Widya dana paramitha A</b>
                                        <br> 1140006910718
                                        <br> <b>Bank BCA a/n Widya Danaparamita Ayuningtyas</b>
                                        <br> 2330193657
                                        <br> <b>Bank BNI a/n Widya Danaparamita Ayuningtyas</b>
                                        <br> 0696694427
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('member.pemesanan.checkout') }}" method="post"
                                        enctype="multipart/form-data" id="checkoutForm" class="row">
                                        <div class="col-md-6 offset-md-6">
                                            <h4>Bayar dan Checkout</h4>
                                            @csrf
                                            <div class="form-group float-right">
                                                <label for="bukti_bayar">Upload Bukti Bayar</label>
                                                <input type="file"
                                                    class="form-control @error('bukti_bayar') is-invalid @enderror"
                                                    name="bukti_bayar" id="bukti_bayar">
                                                @error('bukti_bayar')
                                                    <div class="text-danger fs-6">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 offset-md-6">
                                            <div class="float-right">
                                                <strong>Total Harga:
                                                    Rp.{{ number_format($totalHarga, 2, ',', '.') }}</strong>
                                                <button type="submit" class="btn btn-primary"
                                                    id="checkoutButton">Checkout</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#checkoutButton').on('click', function(e) {
                // Mencegah submit form secara otomatis
                e.preventDefault();

                // Cek apakah file bukti bayar sudah diisi
                var buktiBayar = $('#bukti_bayar').val();
                if (!buktiBayar) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Silakan upload bukti bayar terlebih dahulu.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Periksa ekstensi file
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                    if (!allowedExtensions.exec(buktiBayar)) {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Ekstensi file bukti bayar tidak valid. Gunakan format JPG, JPEG, atau PNG.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Submit form jika file bukti bayar sudah diisi dan memiliki ekstensi yang valid
                        $('#checkoutForm').submit();
                    }
                }
            });
        });
    </script>
@endsection
