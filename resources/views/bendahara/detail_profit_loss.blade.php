@extends('layout.master')

@section('content')
    <main id="main" class="main">
        <div class="data-laporan">
            Detail Laba Rugi Tahun {{ $year }}
        </div><!-- End Page Title -->

        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Laba Rugi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $item)
                        <tr>
                            <td>{{ $item->month }}</td>
                            <td>{{ $item->pemasukan }}</td>
                            <td>{{ $item->pengeluaran }}</td>
                            <td>{{ $item->laba_rugi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
