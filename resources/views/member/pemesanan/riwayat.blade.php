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

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
            "columns": [{
                    "data": "created_at",
                    "render": function(data, type, row) {
                        // Menggunakan Carbon untuk memformat tanggal
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
                    "defaultContent": '<button class="btn btn-info btn-sm">Details</button>'
                },
            ],
            "createdRow": function(row, data, index) {
                $(row).addClass('clickable').attr('data-toggle', 'tooltip').attr('title',
                    'Click to view details');
            }
        });

        // Handle row click event
        $('#example tbody').on('click', 'tr', function() {
            var data = dataTable.row(this).data();
            var id = data.id; // Ganti dengan nama kolom yang sesuai

            // Perbaikan pada baris ini
            var detailsRow = dataTable.row(this).child;

            if (detailsRow.isShown()) {
                detailsRow.hide();
            } else {
                $.ajax({
                    url: "/member/get-detail-pemesanan/" + id, // Ganti dengan URL yang sesuai
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Ubah ini sesuai dengan struktur data yang Anda terima dari server
                        detailsRow.show();
                        detailsRow(format(response)).show(); // Perbaikan pada baris ini
                    }
                });
            }
        });

        function format(data) {
            // Ubah ini sesuai dengan tampilan detail yang Anda inginkan
            var html = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            html += '<tr><th>Paket</th><th>Menu</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>'
            for (var i = 0; i < data.length; i++) {
                html += '<tr>' +
                    '<td>' + data[i].menu.paket.nama_paket + '</td>' +
                    '<td>' + data[i].menu.menu + '</td>' +
                    '<td>' + data[i].jumlah + '</td>' +
                    '<td>' + data[i].harga_per_item + '</td>' +
                    '<td>' + data[i].harga_total + '</td>' +
                    '</tr>';
            }
            html += '</table>';
            return html;
        }
    </script>
@endsection
