@extends('layouts.admin-main')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat Datang di Dashboard</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            {{-- <div class="input-group date datepicker wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar"
                        class=" text-primary"></i></span>
                <input type="text" class="form-control border-primary bg-transparent">
            </div>
            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="printer"></i>
                Print
            </button>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                Download Report
            </button> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                        <h6 class="card-title mb-0">Jadwal Catering dan Alamat Kirim Hari ini</h6>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-7">
                            <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business
                                has from its normal business activities, usually from the sale of goods and
                                services to customers.</p>
                        </div>
                        <div class="col-md-5 d-flex justify-content-md-end">
                            <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary">Today</button>
                                <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                                <button type="button" class="btn btn-outline-primary">Month</button>
                                <button type="button" class="btn btn-outline-primary">Year</button>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title my-2">Sarapan</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Viona</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 06:00 - 08:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Dio</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 06:00 - 08:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Alwi</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 06:00 - 08:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        {{-- @foreach ($makan_siang as $siang)
                        @endforeach --}}
                    </div>
                    <h4 class="card-title my-2">Makan Siang</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Viona</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 10:00 - 12:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Dio</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 10:00 - 12:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Alwi</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 10:00 - 12:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-title my-2">Makan Malam</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Viona</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 17:00 - 19:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Dio</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 17:00 - 19:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Alwi</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Paket Healthy 17:00 - 19:00</h6>
                                    <p class="card-text">Jl. Suryalaya XIII No.11, Cijagra, Kec. Lengkong, Kota Bandung,
                                        Jawa Barat 40265
                                    </p>
                                    <a href="#" class="card-link">Lihat Maps</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
@section('script')
@endsection
