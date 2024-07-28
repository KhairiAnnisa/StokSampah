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
    .data-sampah {
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
        <div class="data-sampah">
            Data Sampah Kotor
        </div><!-- End Page Title -->

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
                        <form action="/smph_ktr" id="formTambahDataForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id_user" name="id_user" class="form-control"
                                    value="{{ Auth::user()->id }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="id_rute">Pilih Rute</label>
                                <select id="id_rute" name="id_rute" class="form-control" required>
                                    <option value="" disabled selected>Pilih Rute</option>
                                    @foreach ($rute as $item)
                                        <option value="{{ $item->id_rute }}">{{ $item->detail_rute }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="total_berat">Total Berat (Kg)</label>
                                <input id="total_berat" name="total_berat" class="form-control" required>
                            </div>

                            <button type="button" class="btn-white-green-border" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-green">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                            <th>Tanggal</th>
                                            <th>Total Berat (Kg)</th>
                                            <th>Rute</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-sampahkotor">
                                        @foreach ($smph_ktr as $smph_ktr)
                                            <tr>
                                                <td>{{ $smph_ktr->tgl_sampahkotor }}</td>
                                                <td>{{ $smph_ktr->total_berat }} Kg</td>
                                                <td>{{ $smph_ktr->rute[0]->detail_rute ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('smph_ktr.edit', $smph_ktr->id_sampahkotor) }}"
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
        {{-- @if (!empty($smph_ktr))
            @foreach ($smph_ktr as $smph_ktr)
                <tr>
                    <td>{{ dd($smph_ktr->tgl_sampahkotor) }}</td>
                </tr>
            @endforeach
        @endif --}}
    </main><!-- End #main -->
@endsection
