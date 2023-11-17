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
                                        Member</span></a>
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
                                            <th class="pt-0">Nama Lengkap</th>
                                            <th class="pt-0">Email</th>
                                            <th class="pt-0">Foto</th>
                                            <th class="pt-0">Alamat Kirim</th>
                                            <th class="pt-0">Nomor WA</th>
                                            <th class="pt-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $member->user->name }}</td>
                                                <td>{{ $member->user->email }}</td>
                                                <td><img src="{{ asset('storage/' . $member->user->image) }}" alt=""
                                                        class="img-thumbnail"></td>
                                                <td>{{ $member->alamat_kirim }}</td>
                                                <td>{{ $member->nomor_wa }}</td>
                                                <td>
                                                    {{-- <a href="/admin/member/{{ $member->id }}"
                                                        class="badge bg-primary d-inline-block">Detail</a> --}}
                                                    <a href="#" class="badge bg-success d-inline-block editButton"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $member->user->id }}"
                                                        data-name="{{ $member->user->name }}"
                                                        data-user_id="{{ $member->user_id }}"
                                                        data-member_id="{{ $member->id }}"
                                                        data-email="{{ $member->user->email }}"
                                                        data-image="{{ $member->user->image }}"
                                                        data-role="{{ $member->user->role }}"
                                                        data-alamat_kirim="{{ $member->alamat_kirim }}"
                                                        data-nomor_wa="{{ $member->nomor_wa }}">Edit</a>

                                                    <form action="/admin/user/{{ $member->id }}" method="post"
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
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/user" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" id="role" value="member">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror" id="image"
                                value="{{ old('image') }}">
                            @error('image')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                            <input type="text" name="alamat_kirim"
                                class="form-control @error('alamat_kirim') is-invalid @enderror" id="alamat_kirim"
                                value="{{ old('alamat_kirim') }}">
                            @error('alamat_kirim')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                            <input type="text" name="nomor_wa"
                                class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa"
                                value="{{ old('nomor_wa') }}">
                            @error('nomor_wa')
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
                    <h1 class="modal-title fs-5" id="editModalLabel">Ubah Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/user/" method="post" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="member_id" id="member_id" value="">
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input type="hidden" name="role" id="role" value="member">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror" id="image"
                                value="{{ old('image') }}">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img id="image-preview" src="" alt="Preview" class="img-thumbnail mt-2">
                                </div>
                            </div>
                            @error('image')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat_kirim" class="form-label">Alamat Kirim</label>
                            <input type="text" name="alamat_kirim"
                                class="form-control @error('alamat_kirim') is-invalid @enderror" id="alamat_kirim"
                                value="{{ old('alamat_kirim') }}">
                            @error('alamat_kirim')
                                <div class="text-danger fs-6">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                            <input type="text" name="nomor_wa"
                                class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa"
                                value="{{ old('nomor_wa') }}">
                            @error('nomor_wa')
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
            var user_id = $(this).data('user_id');
            $(".modal-body  #user_id").val(user_id);
            var member_id = $(this).data('member_id');
            $(".modal-body  #member_id").val(member_id);
            $("#formEdit").attr("action", "/admin/user/" + id);

            var name = $(this).data('name');
            $(".modal-body  #name").val(name);
            var email = $(this).data('email');
            $(".modal-body  #email").val(email);
            var image = $(this).data('image');
            $(".modal-body #image-preview").attr("src", "{{ asset('storage/') }}" + "/" + image);

            // var image = $(this).data('image');
            // $(".modal-body  #image").val(image);
            var role = $(this).data('role');
            $(".modal-body  #role").val(role);
            var alamat_kirim = $(this).data('alamat_kirim');
            $(".modal-body  #alamat_kirim").val(alamat_kirim);
            var nomor_wa = $(this).data('nomor_wa');
            $(".modal-body  #nomor_wa").val(nomor_wa);
        });
        $(document).on("click", "#addButton", function() {
            $(".modal-body textarea").val(''); // Mengosongkan nilai pada elemen textarea
            $(".modal-body input").val(''); // Mengosongkan nilai pada elemen input
            $(".modal-body select").val(''); // Mengosongkan nilai pada elemen select option
            $(".modal-body  #role").val('member');
        });

        $(document).ready(function() {
            // Menggunakan on() untuk menangani perubahan input file di dalam modal
            $(document).on("change", "#image", function() {
                readURL(this);
            });

            // Fungsi untuk membaca URL gambar dan mengganti gambar pratinjau
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#image-preview").attr("src", e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection
