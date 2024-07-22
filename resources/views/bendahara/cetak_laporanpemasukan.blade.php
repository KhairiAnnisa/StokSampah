<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pemasukan</title>
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
        <h1>Laporan Pemasukan</h1>
        <p>Tanggal: {{ $tanggal_awal }} - {{ $tanggal_akhir }}</p>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item['tanggal'] }}</td>
                        <td>{{ $item['kategori'] }}</td>
                        <td>{{ number_format($item['nominal'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th>{{ number_format($total_nominal, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
