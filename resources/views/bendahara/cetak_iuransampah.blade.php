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
        <h1>Data Iuran Sampah</h1>
        <p>Laporan ini dibuat pada {{ date('d M Y') }}</p>

        <div class="summary">
            <h2>Ringkasan Data</h2>
            <p>Total Iuran: {{ $iuran->count() }}</p>
            <!-- Tambahkan informasi ringkasan lainnya di sini -->
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Warga</th>
                    <th>Bulan</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Status</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iuran as $iuran)
                    <tr>
                        <td>{{ $iuran->warga[0]->nama_warga ?? 'N/A' }}</td>
                        <td>{{ $iuran->bulan }}</td>
                        <td>{{ $iuran->tgl_iuransampah }}</td>
                        <td>{{ $iuran->harga }}</td>
                        <td>{{ $iuran->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
