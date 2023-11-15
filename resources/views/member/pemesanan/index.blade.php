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
                            <div class="row">
                                <div class="col-md-6 offset-md-6">
                                    <!-- Gunakan offset untuk membuat kolom kosong di sisi kiri -->
                                    <div class="float-right">
                                        <strong>Total Harga: Rp.{{ number_format($totalHarga, 2, ',', '.') }}</strong>
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->
@endsection
