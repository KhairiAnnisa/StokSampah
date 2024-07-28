<!DOCTYPE html>
<html>

<head>
    <title>Data Warga</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 15px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        h1 {
            text-align: left;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #40513b;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .summary {
            margin-top: 20px;
            text-align: left;
        }

        .summary h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .summary p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/img/kop_surat.jpg') }}" alt="Kop Surat">
        </div>
        <h1>Data Warga</h1>
        <p>Laporan ini dibuat pada {{ date('d M Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Nama Warga</th>
                    <th>No Handphone Warga</th>
                    <th>Blok</th>
                    <th>Alamat</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>RT</th>
                    <th>RW</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warga as $item)
                    <tr>
                        <td>{{ $item->nama_warga }}</td>
                        <td>{{ $item->no_hp_warga }}</td>
                        <td>{{ $item->blok }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->kelurahan }}</td>
                        <td>{{ $item->kecamatan }}</td>
                        <td>{{ $item->rt }}</td>
                        <td>{{ $item->rw }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="summary">
            <p>Total Warga: {{ $warga->count() }}</p>
            <!-- Tambahkan informasi distribusi demografi atau statistik lainnya di sini -->
        </div>
    </div>
</body>

</html>
