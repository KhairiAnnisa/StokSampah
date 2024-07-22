<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Gaji;
use App\Models\Cost;

class Laporan_PengeluaranController extends Controller
{
    public function index()
    {
        $data = [];
        return view('bendahara.laporanpengeluaran', compact('data'));
    }

    public function cetak(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $kategori = $request->kategori;

        $data = [];
        $total_nominal = 0;

        if (in_array('gaji', $kategori)) {
            $gaji = Gaji::whereBetween('tgl_gaji', [$tanggal_awal, $tanggal_akhir])->get();
            foreach ($gaji as $item) {
                $data[] = [
                    'tanggal' => $item->tgl_gaji,
                    'kategori' => 'Gaji',
                    'nominal' => $item->upah + $item->thr,
                ];
                $total_nominal += $item->upah + $item->thr;
            }
        }

        if (in_array('cost', $kategori)) {
            $cost = Cost::whereBetween('tgl_cost', [$tanggal_awal, $tanggal_akhir])->get();
            foreach ($cost as $item) {
                $data[] = [
                    'tanggal' => $item->tgl_cost,
                    'kategori' => 'Cost',
                    'nominal' => $item->biaya,
                ];
                $total_nominal += $item->biaya;
            }
        }

        if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('bendahara.cetak_laporanpengeluaran', compact('data', 'tanggal_awal', 'tanggal_akhir', 'total_nominal'));
            return $pdf->download('laporan_pengeluaran.pdf');
        }

        return view('bendahara.laporanpengeluaran', compact('data', 'tanggal_awal', 'tanggal_akhir'));
    }
}
