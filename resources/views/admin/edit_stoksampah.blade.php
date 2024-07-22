@extends('layout.master')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

    .card {
        border-radius: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 700;
        margin-bottom: 5px;

    }

    .btn-green {
        background-color: #738D6F;
        color: white;
        padding: 9px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        margin-top: 10px;
        border: none;
        cursor: pointer;
    }

    .btn-green:hover {
        background-color: #5c7058;
    }

    .btn-white-green-border {
        background-color: white;
        border: 3px solid #7C9070;
        border-radius: 10px 10px 10px 10px;
        padding: 5px 15px;
        color: #40513B;
        font-weight: 600;
        margin-right: 15px;
    }

    .btn-white-green-border:hover {
        background-color: #A4BC92;
        color: white;
    }
</style>
@section('content')
    <main id="main" class="main">
        <div class="data-sampah">
            Mengubah Data Sampah
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row justify-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Diubah',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                </script>
                            @endif
                            <form method="POST" action="{{ route('sampah.update', $sampah->id_sampah) }}" class="p-2">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="edit_nama_sampah">Nama Sampah</label>
                                    <input type="text" id="edit_nama_sampah" name="nama_sampah" class="form-control"
                                        value="{{ $sampah->nama_sampah }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_stok_sampah">Stok Sampah</label>
                                    <input type="text" id="edit_stok_sampah" name="stok_sampah" class="form-control"
                                        value="{{ $sampah->stok_sampah }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_kategori">Kategori</label>
                                    <input type="text" id="edit_kategori" name="kategori" class="form-control"
                                        value="{{ $sampah->kategori }}" required>
                                </div>

                                <button type="button" class="btn-white-green-border" onclick="goBack()">Batal</button>
                                <button type="submit" class="btn-green">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
