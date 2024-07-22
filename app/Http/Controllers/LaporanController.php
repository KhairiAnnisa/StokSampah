<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    protected $monthNames = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];
    public function generateReport()
    {
        // Fetch and summarize data from each table

        // Gaji
        $gaji = DB::table('gaji')
            ->select(DB::raw('MONTH(tgl_gaji) as month'), DB::raw('SUM(upah) as total_upah'))
            ->groupBy('month')
            ->get();

        // Iuran
        $iuran = DB::table('iuransampah')
            ->select(DB::raw('MONTH(tgl_iuransampah) as month'), DB::raw('SUM(harga) as total_harga'))
            ->groupBy('month')
            ->get();

        // Sampah Keluar
        $sampahkeluar = DB::table('sampahkeluar')
            ->select(DB::raw('MONTH(tgl_sampahkeluar) as month'), DB::raw('SUM(total_sampahkeluar) as total_sampahkeluar'))
            ->groupBy('month')
            ->get();

        // Cost
        $cost = DB::table('cost')
            ->select(DB::raw('MONTH(tgl_cost) as month'), DB::raw('SUM(biaya) as total_biaya'))
            ->groupBy('month')
            ->get();

        // Combine data into a report
        $report = [];

        for ($i = 1; $i <= 12; $i++) {
            $report[$this->monthNames[$i]] = [
                'gaji' => [
                    'total_upah' => $gaji->firstWhere('month', $i)->total_upah ?? 0,
                ],
                'iuran' => $iuran->firstWhere('month', $i)->total_harga ?? 0,
                'sampahkeluar' => [
                    'total_sampahkeluar' => $sampahkeluar->firstWhere('month', $i)->total_sampahkeluar ?? 0,
                ],
                'cost' => $cost->firstWhere('month', $i)->total_biaya ?? 0,
            ];
        }

        // Display the report
        return view('bendahara.tabel_laporan', ['report' => $report]);
    }

    public function cetak()
    {
        // Fetch and summarize data from each table
        $gaji = DB::table('gaji')
            ->select(DB::raw('MONTH(tgl_gaji) as month'), DB::raw('SUM(upah) as total_upah'))
            ->groupBy('month')
            ->get();

        $iuran = DB::table('iuransampah')
            ->select(DB::raw('MONTH(tgl_iuransampah) as month'), DB::raw('SUM(harga) as total_harga'))
            ->groupBy('month')
            ->get();

        $sampahkeluar = DB::table('sampahkeluar')
            ->select(DB::raw('MONTH(tgl_sampahkeluar) as month'), DB::raw('SUM(total_sampahkeluar) as total_sampahkeluar'))
            ->groupBy('month')
            ->get();

        $cost = DB::table('cost')
            ->select(DB::raw('MONTH(tgl_cost) as month'), DB::raw('SUM(biaya) as total_biaya'))
            ->groupBy('month')
            ->get();

        // Combine data into a report
        $report = [];

        for ($i = 1; $i <= 12; $i++) {
            $report[$this->monthNames[$i]] = [
                'gaji' => [
                    'total_upah' => $gaji->firstWhere('month', $i)->total_upah ?? 0,
                ],
                'iuran' => $iuran->firstWhere('month', $i)->total_harga ?? 0,
                'sampahkeluar' => [
                    'total_sampahkeluar' => $sampahkeluar->firstWhere('month', $i)->total_sampahkeluar ?? 0,
                ],
                'cost' => $cost->firstWhere('month', $i)->total_biaya ?? 0,
            ];
        }

        // Display the report for printing
        $pdf = PDF::loadView('bendahara.cetak_laporan', ['report' => $report]);
        return $pdf->download('data_laporan.pdf');
    }
}
