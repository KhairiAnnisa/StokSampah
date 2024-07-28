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

    .btn-green {
        background-color: #738D6F;
        color: white;
        padding: 9px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
        border: none;
        cursor: pointer;
    }

    .btn-green:hover {
        background-color: #5c7058;
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
        margin-left: 8px;
    }

    .btn-white-green-border:hover {
        background-color: #A4BC92;
    }
</style>

@section('content')
    <main id="main" class="main">
        <div class="data-laporan">
            Laporan Pengeluaran
        </div><!-- End Page Title -->

        <div class="container">
            <form action="{{ route('laporan.pengeluaran.cetak') }}" method="GET">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kategori</label><br>
                        <div class="form-check form-check-inline col-md-3">
                            <input class="form-check-input" type="checkbox" id="gaji" name="kategori[]" value="gaji">
                            <label class="form-check-label" for="gaji">Gaji</label>
                        </div>
                        <div class="form-check form-check-inline col-md-3">
                            <input class="form-check-input" type="checkbox" id="cost" name="kategori[]" value="cost">
                            <label class="form-check-label" for="cost">Cost</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-green" name="filter">Filter</button>
                <button type="submit" class="btn-white-green-border" name="download_pdf">Cetak Laporan</button>
            </form>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-cost">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item['tanggal'] }}</td>
                                                <td>{{ $item['kategori'] }}</td>
                                                <td>Rp {{ number_format($item['nominal'], 0, ',', '.') }}</td>
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
    </main>
@endsection
