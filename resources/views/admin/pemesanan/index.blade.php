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
                                        Pemesanan</span></a>
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
                                            <th class="pt-0">Nama Member</th>
                                            <th class="pt-0">Harga</th>
                                            <th class="pt-0">Harga Diskon</th>
                                            <th class="pt-0">Status</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemesanans as $pemesanan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pemesanan->member->user->name }}</td>
                                                <td>{{ $pemesanan->total_harga }}</td>
                                                <td>{{ $pemesanan->harga_diskon }}</td>
                                                <td>{{ $pemesanan->status }}</td>
                                                <td>
                                                    <a href="#" class="badge bg-success d-inline-block editButton"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $pemesanan->id }}"
                                                        data-member_id="{{ $pemesanan->member_id }}"
                                                        data-diskon="{{ $pemesanan->diskon }}"
                                                        data-total_harga="{{ $pemesanan->total_harga }}"
                                                        data-harga_diskon="{{ $pemesanan->harga_diskon }}"
                                                        data-bukti_bayar="{{ $pemesanan->bukti_bayar }}"
                                                        data-status="{{ $pemesanan->status }}">Edit</a>

                                                    <a href="/admin/pemesanan/{{ $pemesanan->id }}"
                                                        class="badge bg-primary d-inline-block">Detail
                                                        Pesanan</a>
                                                    <a href="#" class="badge bg-info d-inline-block buktiBayar"
                                                        data-bukti_bayar="{{ $pemesanan->bukti_bayar }}">Lihat Bukti
                                                        Bayar</a>

                                                    <form action="/admin/pemesanan/{{ $pemesanan->id }}" method="post"
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
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Pemesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/pemesanan" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="member_id" class="form-label">Member</label>
                            <select name="member_id" class="form-select @error('member_id') is-invalid @enderror"
                                id="member_id">
                                <option value="" selected disabled>Pilih Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" @selected($member->id == old('member_id'))>
                                        {{ $member->user->name }}</option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror"
                                id="diskon" value="{{ old('diskon') }}" placeholder="10"> %
                            @error('diskon')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="number" name="total_harga"
                                class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                                value="{{ old('total_harga') }}">
                            @error('total_harga')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_diskon" class="form-label">Harga Diskon</label>
                            <input type="number" name="harga_diskon"
                                class="form-control @error('harga_diskon') is-invalid @enderror" id="harga_diskon"
                                value="{{ old('harga_diskon') }}">
                            @error('harga_diskon')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror"
                                id="status">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="proses" @selected('proses' == old('status'))>Proses</option>
                                <option value="selesai" @selected('selesai' == old('status'))>Selesai</option>
                                <option value="batal" @selected('batal' == old('status'))>Batal</option>
                            </select>
                            @error('status')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bukti_bayar" class="form-label">Bukti Bayar</label>
                            <input type="file" name="bukti_bayar"
                                class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar"
                                value="{{ old('bukti_bayar') }}">
                            @error('bukti_bayar')
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
                    <h1 class="modal-title fs-5" id="editModalLabel">Ubah Pemesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/pemesanan/" method="post" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">

                        <div class="mb-3">
                            <label for="member_id" class="form-label">Member</label>
                            <select name="member_id" class="form-select @error('member_id') is-invalid @enderror"
                                id="member_id">
                                <option value="" selected disabled>Pilih Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" @selected($member->id == old('member_id'))>
                                        {{ $member->user->name }}</option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="number" name="diskon"
                                class="form-control @error('diskon') is-invalid @enderror" id="diskon"
                                value="{{ old('diskon') }}" placeholder="10"> %
                            @error('diskon')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="number" name="total_harga"
                                class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                                value="{{ old('total_harga') }}">
                            @error('total_harga')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_diskon" class="form-label">Harga Diskon</label>
                            <input type="number" name="harga_diskon"
                                class="form-control @error('harga_diskon') is-invalid @enderror" id="harga_diskon"
                                value="{{ old('harga_diskon') }}">
                            @error('harga_diskon')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror"
                                id="status">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="proses" @selected('proses' == old('status'))>Proses</option>
                                <option value="selesai" @selected('selesai' == old('status'))>Selesai</option>
                                <option value="batal" @selected('batal' == old('status'))>Batal</option>
                            </select>
                            @error('status')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bukti_bayar" class="form-label">Bukti Bayar</label>
                            <input type="file" name="bukti_bayar"
                                class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar"
                                value="{{ old('bukti_bayar') }}">
                            @error('bukti_bayar')
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
            $("#formEdit").attr("action", "/admin/pemesanan/" + id);

            var member_id = $(this).data('member_id');
            $(".modal-body  #member_id").val(member_id);
            var diskon = $(this).data('diskon');
            $(".modal-body  #diskon").val(diskon);
            var total_harga = $(this).data('total_harga');
            $(".modal-body  #total_harga").val(total_harga);
            var harga_diskon = $(this).data('harga_diskon');
            $(".modal-body  #harga_diskon").val(harga_diskon);
            var status = $(this).data('status');
            $(".modal-body  #status").val(status);
            var bukti_bayar = $(this).data('bukti_bayar');
            $(".modal-body  #bukti_bayar").val(bukti_bayar);
        });
        $(document).on("click", "#addButton", function() {
            $(".modal-body textarea").val(''); // Mengosongkan nilai pada elemen textarea
            $(".modal-body input").val(''); // Mengosongkan nilai pada elemen input
            $(".modal-body select").val(''); // Mengosongkan nilai pada elemen select option
        });
    </script>
@endsection
