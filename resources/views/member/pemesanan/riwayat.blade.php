@extends('layouts.main')
@php
    use Carbon\Carbon;
@endphp
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title mb-3">
                <span><em></em></span>
                <h2 id="orderFood">Riwayat Pemesanan</h2>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Riwayat Pemesanan Saya</h4>
                    <div class="container mt-5 mb-1" id="keranjang">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Bukti Bayar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal Testimoni -->
    <div class="modal fade" id="testimoniModal" tabindex="-1" role="dialog" aria-labelledby="testimoniModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testimoniModalLabel">Isi Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('member.testimoni.store') }}" method="post" id="testimoniForm">
                    <div class="modal-body">
                        <!-- Form untuk mengisi testimoni -->
                        @csrf
                        <div class="form-group">
                            <label for="testimoniTextarea">Testimoni:</label>
                            <textarea class="form-control" id="testimoniTextarea" rows="3" name="testimoni" placeholder="isi testimoni..."></textarea>
                            <hr>
                        </div>
                        <!-- tambahkan input tersembunyi untuk menyimpan item_id atau informasi lain yang diperlukan -->
                        <input type="hidden" id="itemIdInput" name="item_id" value="">
                        <input type="hidden" id="memberIdInput" name="member_id" value="{{ auth()->user()->member->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        {{-- <button type="button" class="btn btn-primary" id="submitTestimoniBtn">Kirim</button> --}}
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Library Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <!-- Set lokal Bahasa Indonesia -->
    <script>
        moment.locale('id');
    </script>

    <script>
        var dataTable = $('#example').DataTable({
            "ajax": {
                "url": "{{ route('get-riwayat') }}", // Ganti dengan route yang sesuai
                "type": "GET",
            },
            // ...

            "columns": [{
                    "data": "created_at",
                    "render": function(data, type, row) {
                        return moment(data).format('LLLL');
                    }
                },
                {
                    "data": "total_harga"
                },
                {
                    "data": "bukti_bayar",
                    "render": function(data, type, row) {
                        return '<img src="{{ asset('storage') }}/' + data +
                            '" class="img-thumbnail" style="max-width: 100px;">';
                    }
                },
                {
                    "data": "status"
                },
                {
                    "data": null,
                    "orderable": false,
                    "className": 'details-control',
                    "defaultContent": '<button class="btn btn-info btn-sm details-btn">Details</button>'
                },
            ],
            // ...
            "createdRow": function(row, data, index) {
                $(row).addClass('clickable').attr('data-toggle', 'tooltip').attr('title',
                    'Click to view details');
            }
        });

        // Handle row click event
        $('#example tbody').on('click', 'button.details-btn', function() {
            var data = dataTable.row($(this).parents('tr')).data();
            var id = data.id;

            var detailsRow = dataTable.row($(this).parents('tr')).child;

            if (detailsRow.isShown()) {
                detailsRow.hide();
            } else {
                $.ajax({
                    url: "/member/get-detail-pemesanan/" + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        detailsRow.show();
                        detailsRow(format(response)).show();
                    }
                });
            }
        });

        function cekTestimoni(itemId) {
            var testimoni = null;
            if (itemId) {
                $.ajax({
                    url: "/member/get-testimoni/" + itemId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.testimoni && response.testimoni.testimoni) {
                            testimoni = response.testimoni;
                            console.log(testimoni); //saya ingin data testimoni di sini,
                            return testimoni;
                        }
                    }
                });
            }
        }

        function format(data) {
            var html = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            html +=
                '<tr><th>Paket</th><th>Menu</th><th>Tanggal Kirim</th><th>Waktu Makan</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th><th>Testimoni</th><th>Aksi</th></tr>';
            for (var i = 0; i < data.length; i++) {
                var currentIndex = i;

                html += '<tr>' +
                    '<td>' + data[i].menu.paket.nama_paket + '</td>' +
                    '<td>' + data[i].menu.menu + '</td>' +
                    '<td>' + moment(data[i].menu.tanggal).format('LL') + '</td>' +
                    '<td>' + data[i].menu.waktu_makan + '</td>' +
                    '<td>' + data[i].jumlah + '</td>' +
                    '<td>' + data[i].harga_per_item + '</td>' +
                    '<td>' + data[i].harga_total + '</td>' +
                    '<td>' + (data[i].testimoni || '') + '</td>' +
                    '<td>';
                var testimoni = null;
                testimoni = cekTestimoni(data[i].id);

                console.log(testimoni); // bisa dibaca di sini
                if (data[i].testimoni) {
                    html += '<span class="text-success">Testimoni Dikirim</span>';
                } else {
                    html +=
                        '<button class="btn btn-primary btn-sm testimoni-btn" data-toggle="modal" data-target="#testimoniModal" data-item_id="' +
                        data[i].id + '">Isi Testimoni</button>';

                }

                html += '</td></tr>';
            }
            html += '</table>';
            return html;
        }

        // Tangani klik tombol "Isi Testimoni" di dalam modal
        $('#example tbody').on('click', 'button.testimoni-btn', function() {
            var data = dataTable.row($(this).parents('tr')).data();
            var itemId = $(this).data('item_id');

            // Set nilai input tersembunyi untuk item_id
            $('#itemIdInput').val(itemId);

            // Tampilkan modal
            $('#testimoniModal').modal('show');
        });

        // Tangani klik tombol "Submit Testimoni" di dalam modal
        $('#submitTestimoniBtn').on('click', function() {
            // Lakukan pengiriman formulir testimoni ke server menggunakan AJAX
            $.ajax({
                url: "{{ route('member.testimoni.store') }}", // Ganti dengan route yang sesuai
                type: 'POST',
                data: $('#testimoniForm').serialize(),
                success: function(response) {
                    $('#testimoniModal').modal('hide');
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.success,
                            icon: 'success'
                        });

                    } else if (response.error) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.error,
                            icon: 'error'
                        });
                    }
                }
            });
        });
    </script>
@endsection
