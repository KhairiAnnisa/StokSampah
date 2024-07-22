<!DOCTYPE html>
<html>

<head>
    <title>Data Laporan Keuangan</title>
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
        <h1>Data Laporan Keuangan</h1>
        <p>Laporan ini dibuat pada {{ date('d M Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Upah</th>
                    <th>Iuran</th>
                    <th>Cost</th>
                    <th>Penjualan Sampah</th>
                    <th>Laba Rugi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $month => $data)
                    <tr>
                        <td>{{ $month }}</td>
                        <td>{{ $data['gaji']['total_upah'] }}</td>
                        <td>{{ $data['iuran'] }}</td>
                        <td>{{ $data['cost'] }}</td>
                        <td>{{ $data['sampahkeluar']['total_sampahkeluar'] }}</td>
                        <td>{{ $data['iuran'] + $data['sampahkeluar']['total_sampahkeluar'] - ($data['gaji']['total_upah'] + $data['cost']) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
