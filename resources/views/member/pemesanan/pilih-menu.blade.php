@extends('layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title mb-3">
                <span><em></em></span>
                {{-- <h2 id="orderFood">Pilih Menu</h2> --}}
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Pilih Menu</h4>
                    @csrf
                    @foreach ($menus->groupBy('paket_id') as $paketId => $menuItems)
                        {{-- Ambil informasi paket --}}
                        @php
                            $paket = \App\Models\Paket::find($paketId);
                        @endphp

                        <h4>Paket {{ $paket->nama_paket }}</h4>

                        @foreach ($menuItems as $menu)
                            @php
                                $badge = 'success';
                                if ($menu->waktu_makan == 'lunch') {
                                    $badge = 'warning';
                                } elseif ($menu->waktu_makan == 'dinner') {
                                    $badge = 'primary';
                                }
                            @endphp
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ Carbon::parse($menu->tanggal)->isoFormat('dddd, LL') }}
                                        <span class="badge badge-{{ $badge }}">{{ $menu->waktu_makan }}</span>
                                    </h5>
                                    <p class="card-text">
                                        <strong>Paket: {{ $paket->nama_paket }}</strong><br>
                                        Nama Menu: {{ $menu->menu }}<br>
                                        Harga: Rp.{{ number_format($paket->harga, 2, ',', '.') }}
                                    </p>
                                    <form action="{{ route('cart.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <input type="number" name="quantity" value="1" min="1">
                                        <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                    <!-- Isi Keranjang -->
                    <div class="container mt-5 mb-1" id="keranjang">
                        <h2>Isi Keranjang</h2>

                        @if (session()->has('cart') && count(session('cart')) > 0)
                            <table class="table">
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
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6 offset-md-6">
                                    <!-- Gunakan offset untuk membuat kolom kosong di sisi kiri -->
                                    <div class="float-right">
                                        <strong>Total Harga: Rp.{{ number_format($totalHarga, 2, ',', '.') }}</strong>
                                        <a href="/member/keranjang" class="btn btn-primary">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Keranjang Anda kosong.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <div id="floating-cart-button" class="floating-cart-button float-right"
        style="position: fixed; top: 80px; right: 20px;">
        <button id="scrollToBottomBtn" class="btn btn-info">Lihat Keranjang</button>
    </div>

@endsection
@section('script')
    <script>
        // Fungsi untuk menentukan apakah elemen dengan ID "keranjang" terlihat dalam viewport
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Menangani perubahan scroll
        $(document).ready(function() {
            // Awalnya sembunyikan tombol
            $("#scrollToBottomBtn").hide();

            // Menangani scroll
            $(window).scroll(function() {
                // Cek apakah elemen #keranjang terlihat dalam viewport
                if (isElementInViewport(document.getElementById("keranjang"))) {
                    // Jika terlihat, sembunyikan tombol
                    $("#scrollToBottomBtn").fadeOut();
                } else {
                    // Jika tidak terlihat, tampilkan tombol
                    $("#scrollToBottomBtn").fadeIn();
                }
            });

            // Menangani klik tombol
            $("#scrollToBottomBtn").click(function() {
                $("html, body").animate({
                    scrollTop: $("#keranjang").offset().top
                }, "slow");
            });
        });
    </script>
    <script>
        // Fungsi untuk mengupdate jumlah item
        function updateQuantity(menuId, quantity) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.update') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    menu_id: menuId,
                    quantity: quantity
                },
                success: function(response) {
                    // Reload halaman setelah update
                    location.reload();
                }
            });
        }

        // Fungsi untuk menghapus item
        function removeItem(menuId) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.remove') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    menu_id: menuId
                },
                success: function(response) {
                    // Reload halaman setelah hapus
                    location.reload();
                }
            });
        }
    </script>
@endsection
