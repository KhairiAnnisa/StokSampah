@extends('layout.master')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/data_warga.css') }}">
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .data-warga {
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
        margin-bottom: 15px;
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

    }

    .btn-white-green-border:hover {
        background-color: #A4BC92;
    }

    .form-group {
        margin-bottom: 15px;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
    }

    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .form-control {
        width: 100%;
    }

    .btn-green,
    .btn-white-green-border,
    .form-control,
    .btn-primary {
        margin-right: 10px;
    }

    .btn-green,
    .btn-white-green-border {
        margin-bottom: 0;
    }

    .form-row .form-group {
        margin-right: 10px;
    }
</style>

@section('content')
    <main id="main" class="main">
        <div class="data-warga">
            Data Warga
        </div><!-- End Page Title -->

        <section class="section">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('warga.cetak') }}">
                <div class="form-row align-items-end">
                    <div class="form-group col-md-3">
                        <label for="alamat">Alamat:</label>
                        <select id="alamat" name="alamat" class="form-control">
                            <option value="">Pilih Alamat</option>
                            @foreach ($alamatList as $alamat)
                                <option value="{{ $alamat->alamat }}">{{ $alamat->alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="rt">RT:</label>
                        <select id="rt" name="rt" class="form-control">
                            <option value="">Pilih RT</option>
                            @foreach ($rtList as $rt)
                                <option value="{{ $rt->rt }}">{{ $rt->rt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="rw">RW:</label>
                        <select id="rw" name="rw" class="form-control">
                            <option value="">Pilih RW</option>
                            @foreach ($rwList as $rw)
                                <option value="{{ $rw->rw }}">{{ $rw->rw }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-white-green-border">Cetak Data</button>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('warga.cetak', request()->query()) }}" class=" " target="_blank">Cetak Semua
                            Data</a>
                    </div>
                </div>
            </form>

            <div class="form-group">
                <button id="btnTambahData" class="btn-green" data-toggle="modal" data-target="#tambahDataModal">Tambah
                    Data</button>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>Nama Warga</th>
                                            <th>No Handphone</th>
                                            <th>Blok</th>
                                            <th>Alamat</th>
                                            <th>Kelurahan</th>
                                            <th>Kecamatan</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-wargas">
                                        @foreach ($warga as $warga)
                                            <tr>
                                                <td>{{ $warga->nama_warga }}</td>
                                                <td>{{ $warga->no_hp_warga }}</td>
                                                <td>{{ $warga->blok }}</td>
                                                <td>{{ $warga->alamat }}</td>
                                                <td>{{ $warga->kelurahan }}</td>
                                                <td>{{ $warga->kecamatan }}</td>
                                                <td>{{ $warga->rt }}</td>
                                                <td>{{ $warga->rw }}</td>
                                                <td>
                                                    <a href="{{ route('warga.edit', $warga->id_warga) }}"
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
                    <form action="/warga" id="formTambahDataForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="id_user" name="id_user" class="form-control"
                                value="{{ Auth::user()->id }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_warga">Nama Warga</label>
                            <input id="nama_warga" name="nama_warga" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp_warga">Nomor Handphone Warga</label>
                            <input id="no_hp_warga" name="no_hp_warga" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="blok">Blok</label>
                            <input id="blok" name="blok" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input id="kelurahan" name="kelurahan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input id="kecamatan" name="kecamatan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input id="rt" name="rt" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input id="rw" name="rw" class="form-control" required>
                        </div>

                        <button type="button" class="btn-white-green-border" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-green">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
