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
        <h1>Data Stok Sampah</h1>
        <p>Laporan ini dibuat pada {{ date('d M Y') }}</p>

        <div class="summary">
            <h2>Ringkasan Data</h2>
            <p>Total Sampah: {{ $sampah->count() }}</p>
            <!-- Tambahkan informasi distribusi demografi atau statistik lainnya di sini -->
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Sampah</th>
                    <th>Stok Sampah</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sampah as $sampah)
                    <tr>
                        <td>{{ $sampah->nama_sampah }}</td>
                        <td>{{ $sampah->stok_sampah }}</td>
                        <td>{{ $sampah->kategori }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
