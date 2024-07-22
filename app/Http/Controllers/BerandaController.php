<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Gaji;
use App\Models\Iuran_Sampah;
use App\Models\Karyawan;
use App\Models\Sampah;
use App\Models\Sampah_Keluar;
use App\Models\Warga;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalWarga = Warga::count();
        $totalIuranLunas = Iuran_Sampah::where('status', 'lunas')->count();
        $totalIuranBelumLunas = Iuran_Sampah::where('status', 'belum_lunas')->count();
        $totalSampah = Sampah::sum('stok_sampah');
        $totalKaryawan = Karyawan::count();
        $totalCost = Cost::sum('biaya');
        $totalSampahKeluar = Sampah_Keluar::sum('total_sampahkeluar');
        $totalGaji = Gaji::sum('upah');

        // Total Pemasukan
        $totalPemasukanSampah = Sampah_Keluar::where('jenis', 'penjualan_sampah')->sum('total_sampahkeluar');
        $totalPemasukanMagot = Sampah_Keluar::where('jenis', 'penjualan_magot')->sum('total_sampahkeluar');
        $totalPemasukan = $totalPemasukanSampah + $totalPemasukanMagot;

        // Perhitungan Laba Rugi
        $totalPengeluaran = $totalCost + $totalGaji;
        $labaRugi = $totalPemasukan - $totalPengeluaran;

        // Data untuk grafik total sampah masuk berdasarkan nama sampah
        $sampahMasukPerNama = Sampah::join('sampahmasuk', 'sampah.id_sampah', '=', 'sampahmasuk.id_sampah')
            ->selectRaw('nama_sampah, SUM(total_sampahmasuk) as total')
            ->groupBy('nama_sampah')
            ->get();

        // Data untuk grafik sampah masuk berdasarkan kategori
        $sampahMasukByKategori = Sampah::join('sampahmasuk', 'sampah.id_sampah', '=', 'sampahmasuk.id_sampah')
            ->selectRaw('kategori, SUM(total_sampahmasuk) as total')
            ->groupBy('kategori')
            ->get();

        return view('dashboard', compact(
            'totalWarga',
            'totalIuranLunas',
            'totalIuranBelumLunas',
            'totalSampah',
            'totalKaryawan',
            'totalCost',
            'totalSampahKeluar',
            'totalGaji',
            'totalPemasukan',
            'totalPengeluaran',
            'labaRugi',
            'sampahMasukPerNama',
            'sampahMasukByKategori'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
