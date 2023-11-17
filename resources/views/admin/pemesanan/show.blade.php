@extends('layouts.admin-main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ $title }}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                        <h6 class="card-title mb-0">{{ $title }}</h6>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <a class="dropdown-item d-flex align-items-center" href="#" id="addButton"
                                    data-bs-toggle="modal" data-bs-target="#editModal"><i data-feather="plus"
                                        class="icon-sm me-2"></i> <span class="">Tambah
                                        Item</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="dataTableExample">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Menu</th>
                                            <th class="pt-0">Nama Paket</th>
                                            <th class="pt-0">Tanggal Kirim</th>
                                            <th class="pt-0">Waktu Makan</th>
                                            <th class="pt-0">Jumlah</th>
                                            <th class="pt-0">Harga per Item</th>
                                            <th class="pt-0">Harga Total</th>
                                            <th class="pt-0">Testimoni</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->menu->menu }}</td>
                                                <td>{{ $item->menu->paket->nama_paket }}</td>
                                                <td>{{ Carbon::parse($item->menu->tanggal)->isoFormat('LL') }}</td>
                                                <td>{{ $item->menu->waktu_makan }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->harga_per_item }}</td>
                                                <td>{{ $item->harga_total }}</td>
                                                <td>{{ $item->testimoni }}</td>
                                                <td>
                                                    <a href="#" class="badge bg-success d-inline-block editButton"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $item->id }}"
                                                        data-pemesanan_id="{{ $item->pemesanan_id }}"
                                                        data-menu_id="{{ $item->menu_id }}"
                                                        data-jumlah="{{ $item->jumlah }}"
                                                        data-harga_per_item="{{ $item->harga_per_item }}"
                                                        data-harga_total="{{ $item->harga_total }}"
                                                        data-testimoni="{{ $item->testimoni }}">Edit</a>
                                                    <form action="/admin/item/{{ $item->id }}" method="post"
                                                        class="d-inline-block">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="badge bg-danger d-inline-block ms-2 mb-1 badge-a tombol-hapus"
                                                            style="border: none; cursor: pointer;">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/item" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="menu_id" class="form-label">Menu</label>
                            <select name="menu_id" class="form-select @error('menu_id') is-invalid @enderror"
                                id="menu_id">
                                <option value="" selected disabled>Pilih Menu</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" @selected($menu->id == old('menu_id'))>
                                        {{ $menu->tanggal . ' | ' . $menu->waktu_makan . ' | ' . $menu->menu }}</option>
                                @endforeach
                            </select>
                            @error('menu_id')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                id="jumlah" value="{{ old('jumlah') }}">
                            @error('jumlah')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_per_item" class="form-label">Harga Per Item</label>
                            <input type="number" name="harga_per_item"
                                class="form-control @error('harga_per_item') is-invalid @enderror" id="harga_per_item"
                                value="{{ old('harga_per_item') }}">
                            @error('harga_per_item')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_total" class="form-label">Harga Total</label>
                            <input type="number" name="harga_total"
                                class="form-control @error('harga_total') is-invalid @enderror" id="harga_total"
                                value="{{ old('harga_total') }}">
                            @error('harga_total')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Ubah Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/item/" method="post" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="">
                        <div class="mb-3">
                            <label for="menu_id" class="form-label">Menu</label>
                            <select name="menu_id" class="form-select @error('menu_id') is-invalid @enderror"
                                id="menu_id">
                                <option value="" selected disabled>Pilih Menu</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" @selected($menu->id == old('menu_id'))>
                                        {{ $menu->tanggal . ' | ' . $menu->waktu_makan . ' | ' . $menu->menu }}</option>
                                @endforeach
                            </select>
                            @error('menu_id')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                value="{{ old('jumlah') }}">
                            @error('jumlah')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_per_item" class="form-label">Harga Per Item</label>
                            <input type="number" name="harga_per_item"
                                class="form-control @error('harga_per_item') is-invalid @enderror" id="harga_per_item"
                                value="{{ old('harga_per_item') }}">
                            @error('harga_per_item')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_total" class="form-label">Harga Total</label>
                            <input type="number" name="harga_total"
                                class="form-control @error('harga_total') is-invalid @enderror" id="harga_total"
                                value="{{ old('harga_total') }}">
                            @error('harga_total')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> --}}
    <script>
        $(document).on("click", ".editButton", function() {
            var id = $(this).data('id');
            $(".modal-body  #id").val(id);
            $("#formEdit").attr("action", "/admin/item/" + id);

            var pemesanan_id = $(this).data('pemesanan_id');
            $(".modal-body  #pemesanan_id").val(pemesanan_id);
            var menu_id = $(this).data('menu_id');
            $(".modal-body  #menu_id").val(menu_id);
            var jumlah = $(this).data('jumlah');
            $(".modal-body  #jumlah").val(jumlah);
            var harga_per_item = $(this).data('harga_per_item');
            $(".modal-body  #harga_per_item").val(harga_per_item);
            var harga_total = $(this).data('harga_total');
            $(".modal-body  #harga_total").val(harga_total);
            var testimoni = $(this).data('testimoni');
            $(".modal-body  #testimoni").val(testimoni);
        });
        $(document).on("click", "#addButton", function() {
            $(".modal-body textarea").val(''); // Mengosongkan nilai pada elemen textarea
            $(".modal-body input").val(''); // Mengosongkan nilai pada elemen input
            $(".modal-body select").val(''); // Mengosongkan nilai pada elemen select option
        });
    </script>
@endsection
