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
                                        Menu</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">#</th>
                                            <th class="pt-0">Menu</th>
                                            <th class="pt-0">Waktu Makan</th>
                                            <th class="pt-0">Tanggal</th>
                                            <th class="pt-0">Paket</th>
                                            <th class="pt-0">Gambar</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $menu->menu }}</td>
                                                <td>{{ $menu->waktu_makan }}</td>
                                                <td>{{ Carbon::parse($menu->tanggal)->isoFormat('LL') }}</td>
                                                <td>{{ $menu->paket->nama_paket }}</td>
                                                <td><img src="{{ asset('storage/' . $menu->gambar) }}" alt=""
                                                        class="img-thumbnail"></td>
                                                <td>
                                                    <a href="#" class="badge bg-success d-inline-block editButton"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $menu->id }}" data-menu="{{ $menu->menu }}"
                                                        data-waktu_makan="{{ $menu->waktu_makan }}"
                                                        data-tanggal="{{ $menu->tanggal }}"
                                                        data-paket_id="{{ $menu->paket_id }}"
                                                        data-gambar="{{ $menu->gambar }}">Edit</a>

                                                    <form action="/admin/menu/{{ $menu->id }}" method="post"
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
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/menu" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="paket_id" class="form-label">Paket</label>
                            <select name="paket_id" class="form-select @error('paket_id') is-invalid @enderror"
                                id="paket_id">
                                <option value="" selected disabled>Pilih Paket</option>
                                @foreach ($pakets as $paket)
                                    <option value="{{ $paket->id }}" @selected($paket->id == old('paket_id'))>
                                        {{ $paket->nama_paket }}</option>
                                @endforeach
                            </select>
                            @error('paket_id')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="menu" class="form-label">Menu</label>
                            <textarea name="menu" class="form-control @error('menu') is-invalid @enderror" id="menu">{{ old('menu') }}</textarea>
                            @error('menu')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="waktu_makan" class="form-label">Waktu Makan</label>
                            <select name="waktu_makan" class="form-select @error('waktu_makan') is-invalid @enderror"
                                id="waktu_makan">
                                <option value="" selected disabled>Pilih Waktu makan</option>
                                <option value="breakfast" @selected('breakfast' == old('waktu_makan'))>Breakfast</option>
                                <option value="lunch" @selected('lunch' == old('waktu_makan'))>Lunch</option>
                                <option value="dinner" @selected('dinner' == old('waktu_makan'))>Dinner</option>
                            </select>
                            @error('waktu_makan')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar"
                                class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                                value="{{ old('gambar') }}">
                            @error('gambar')
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
                    <h1 class="modal-title fs-5" id="editModalLabel">Ubah Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/menu/" method="post" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="mb-3">
                            <label for="paket_id" class="form-label">Paket</label>
                            <select name="paket_id" class="form-select @error('paket_id') is-invalid @enderror"
                                id="paket_id">
                                <option value="" selected disabled>Pilih Paket</option>
                                @foreach ($pakets as $paket)
                                    <option value="{{ $paket->id }}" @selected($paket->id == old('paket_id'))>
                                        {{ $paket->nama_paket }}</option>
                                @endforeach
                            </select>
                            @error('paket_id')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="menu" class="form-label">Menu</label>
                            <textarea name="menu" class="form-control @error('menu') is-invalid @enderror" id="menu">{{ old('menu') }}</textarea>
                            @error('menu')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="waktu_makan" class="form-label">Waktu Makan</label>
                            <select name="waktu_makan" class="form-select @error('waktu_makan') is-invalid @enderror"
                                id="waktu_makan">
                                <option value="" selected disabled>Pilih Waktu makan</option>
                                <option value="breakfast" @selected('breakfast' == old('waktu_makan'))>Breakfast</option>
                                <option value="lunch" @selected('lunch' == old('waktu_makan'))>Lunch</option>
                                <option value="dinner" @selected('dinner' == old('waktu_makan'))>Dinner</option>
                            </select>
                            @error('waktu_makan')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar"
                                class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                                value="{{ old('gambar') }}">
                            @error('gambar')
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
            $("#formEdit").attr("action", "/admin/menu/" + id);

            var menu = $(this).data('menu');
            $(".modal-body  #menu").val(menu);
            var paket_id = $(this).data('paket_id');
            $(".modal-body  #paket_id").val(paket_id);
            var waktu_makan = $(this).data('waktu_makan');
            $(".modal-body  #waktu_makan").val(waktu_makan);
            var tanggal = $(this).data('tanggal');
            $(".modal-body  #tanggal").val(tanggal);
            var gambar = $(this).data('gambar');
            $(".modal-body  #gambar").val(gambar);
        });
        $(document).on("click", "#addButton", function() {
            $(".modal-body textarea").val(''); // Mengosongkan nilai pada elemen textarea
            $(".modal-body input").val(''); // Mengosongkan nilai pada elemen input
            $(".modal-body select").val(''); // Mengosongkan nilai pada elemen select option
        });
    </script>
@endsection
