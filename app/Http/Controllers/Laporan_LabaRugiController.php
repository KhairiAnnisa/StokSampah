<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Gaji;
use App\Models\Iuran_Sampah;
use App\Models\Sampah_Keluar;
use App\Models\Cost;

class Laporan_LabaRugiController extends Controller
{
    public function labaRugiIndex()
    {
        // Fetch years where there is pemasukan or pengeluaran
        $years = DB::table('gaji')
            ->select(DB::raw('YEAR(tgl_gaji) as year'))
            ->union(
                DB::table('iuransampah')
                    ->select(DB::raw('YEAR(tgl_iuransampah) as year'))
            )
            ->union(
                DB::table('sampahkeluar')
                    ->select(DB::raw('YEAR(tgl_sampahkeluar) as year'))
            )
            ->union(
                DB::table('cost')
                    ->select(DB::raw('YEAR(tgl_cost) as year'))
            )
            ->distinct()
            ->get();

        $labaRugiData = [];

        foreach ($years as $year) {
            $year = $year->year;

            $totalPemasukan = Iuran_Sampah::whereYear('tgl_iuransampah', $year)->sum('harga')
                + Sampah_Keluar::whereYear('tgl_sampahkeluar', $year)->sum('total_sampahkeluar');

            $totalPengeluaran = Gaji::whereYear('tgl_gaji', $year)->sum(DB::raw('upah'))
                + Cost::whereYear('tgl_cost', $year)->sum('biaya');

            $labaRugi = $totalPemasukan - $totalPengeluaran;

            $labaRugiData[] = [
                'year' => $year,
                'labaRugi' => $labaRugi,
            ];
        }

        return view('bendahara.laporan_labarugi', compact('labaRugiData'));
    }

    public function labaRugiDetail($year)
    {
        // Fetch monthly data for the given year
        $report = $this->generateReportForYear($year);

        return view('bendahara.laporan_labarugiDetail', compact('report', 'year'));
    }

    private function generateReportForYear($year)
    {
        // Fetch and summarize data from each table
        $gaji = Gaji::whereYear('tgl_gaji', $year)
            ->select(DB::raw('MONTH(tgl_gaji) as month'), DB::raw('SUM(upah) as total_upah'))
            ->groupBy('month')
            ->get();

        $iuran = Iuran_Sampah::whereYear('tgl_iuransampah', $year)
            ->select(DB::raw('MONTH(tgl_iuransampah) as month'), DB::raw('SUM(harga) as total_harga'))
            ->groupBy('month')
            ->get();

        $sampahkeluar = Sampah_Keluar::whereYear('tgl_sampahkeluar', $year)
            ->select(DB::raw('MONTH(tgl_sampahkeluar) as month'), DB::raw('SUM(total_sampahkeluar) as total_sampahkeluar'))
            ->groupBy('month')
            ->get();

        $cost = Cost::whereYear('tgl_cost', $year)
            ->select(DB::raw('MONTH(tgl_cost) as month'), DB::raw('SUM(biaya) as total_biaya'))
            ->groupBy('month')
            ->get();

        // Combine data into a report
        $report = [];

        for ($i = 1; $i <= 12; $i++) {
            $report[$i] = [
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

        return $report;
    }
}
