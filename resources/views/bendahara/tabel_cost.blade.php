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
    .data-cost {
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
        <div class="data-cost">
            Data Biaya Lainnya
        </div><!-- End Page Title -->

        <section class="section">
            <button id="btnTambahData" class="btn-green" data-toggle="modal" data-target="#tambahDataModal">Tambah
                Data</button>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Pengeluaran</th>
                                            <th>Harga</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-cost">
                                        @foreach ($cost as $cost)
                                            <tr>
                                                <td>{{ $cost->nama_pengeluaran }}</td>
                                                <td>{{ $cost->biaya }}</td>
                                                <td>{{ $cost->tgl_cost }}</td>
                                                <td>
                                                    <a href="{{ route('cost.edit', $cost->id_cost) }}"
                                                        class="btn btn-warning btn-sm btn-edit">Edit</button>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/cost" id="formTambahDataForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="id_user" name="id_user" class="form-control"
                                value="{{ Auth::user()->id }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_pengeluaran">Nama Pengeluaran</label>
                            <input id="nama_pengeluaran" name="nama_pengeluaran" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya</label>
                            <input id="biaya" name="biaya" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_cost">Tanggal</label>
                            <input type="date" id="tgl_cost" name="tgl_cost" class="form-control" required>
                        </div>
 
                        <button type="button" class="btn-white-green-border" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-green">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
