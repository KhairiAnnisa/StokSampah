<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Iuran_Sampah;
use App\Models\Sampah_Keluar;

class Laporan_PemasukanController extends Controller
{
    public function index()
    {
        $data = [];
        return view('bendahara.laporanpemasukan', compact('data'));
    }

    public function cetak(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $kategori = $request->kategori;

        $data = [];
        $total_nominal = 0;

        if (in_array('iuran_sampah', $kategori)) {
            $iuran = Iuran_Sampah::whereBetween('tgl_iuransampah', [$tanggal_awal, $tanggal_akhir])->get();
            foreach ($iuran as $item) {
                $data[] = [
                    'tanggal' => $item->tgl_iuransampah,
                    'kategori' => 'Iuran Sampah',
                    'nominal' => $item->harga,
                ];
                $total_nominal += $item->harga;
            }
        }

        if (in_array('penjualan_sampah', $kategori)) {
            $penjualan = Sampah_Keluar::whereBetween('tgl_sampahkeluar', [$tanggal_awal, $tanggal_akhir])->get();
            foreach ($penjualan as $item) {
                $data[] = [
                    'tanggal' => $item->tgl_sampahkeluar,
                    'kategori' => 'Penjualan Sampah',
                    'nominal' => $item->total_sampahkeluar,
                ];
                $total_nominal += $item->total_sampahkeluar;
            }
        }

        if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('bendahara.cetak_laporanpemasukan', compact('data', 'tanggal_awal', 'tanggal_akhir', 'total_nominal'));
            return $pdf->download('laporan_pemasukan.pdf');
        }

        return view('bendahara.laporanpemasukan', compact('data', 'tanggal_awal', 'tanggal_akhir'));
    }
}
