@extends('layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .data-laporan {
        background-color: #7C9070;
        color: white;
        padding: 10px 50px;
        border-radius: 5px 5px 30px 5px;
        display: inline-block;
        font-size: 17px;
        margin-bottom: 50px;
        font-weight: 600;
    }

    .btn-white-green-border {
        background-color: white;
        border: 2px solid #7C9070;
        border-radius: 5px;
        padding: 7px 15px;
        color: #40513B;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: background-color 0.3s, color 0.3s;
        margin-bottom: 20px;
    }

    .btn-white-green-border:hover {
        background-color: #A4BC92;
    }
</style>

@section('content')
    <main id="main" class="main">
        <div class="data-laporan">
            Data Transaksi Keuangan
        </div><!-- End Page Title -->

        <section class="section">
            <a href="{{ route('report.cetak') }}" class="btn-white-green-border" target="_blank">Cetak Data</a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Upah</th>
                                            <th>Iuran</th>
                                            <th>Cost</th>
                                            <th>Penjualan Sampah</th>
                                            <th>Laba Rugi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($report as $month => $data)
                                            <tr>
                                                <td>{{ $month }}</td>
                                                <td>{{ $data['gaji']['total_upah'] }}</td>
                                                <td>{{ $data['iuran'] }}</td>
                                                <td>{{ $data['cost'] }}</td>
                                                <td>{{ $data['sampahkeluar']['total_sampahkeluar'] }}</td>
                                                <td>{{ $data['iuran'] + $data['sampahkeluar']['total_sampahkeluar'] - ($data['gaji']['total_upah'] + $data['cost']) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
