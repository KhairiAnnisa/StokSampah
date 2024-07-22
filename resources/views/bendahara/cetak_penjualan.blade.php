<!DOCTYPE html>
<html>

<head>
    <title>Data Iuran Sampah</title>
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
        <h1>Data Penjualan Sampah</h1>
        <p>Laporan ini dibuat pada {{ date('d M Y') }}</p>

        <div class="summary">
            <h2>Ringkasan Data</h2>
            <p>Total Penjualan: {{ $smph_kel->count() }}</p>
            <!-- Tambahkan informasi ringkasan lainnya di sini -->
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Sampah</th>
                    <th>Harga Sampah</th>
                    <th>Berat Sampah</th>
                    <th>Total Sampah Keluar</th>
                    <th>Jenis Sampah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($smph_kel as $smph_kel)
                    <tr>
                        <td>{{ $smph_kel->tgl_sampahkeluar }}</td>
                        <td>{{ $smph_kel->sampah[0]->nama_sampah ?? 'N/A' }}</td>
                        <td>{{ $smph_kel->harga_sampahkeluar }}</td>
                        <td>{{ $smph_kel->berat_sampahkeluar }}</td>
                        <td>{{ $smph_kel->total_sampahkeluar }}</td>
                        <td>{{ $smph_kel->jenis }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
