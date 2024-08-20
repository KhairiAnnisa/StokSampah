<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Gaji;
use App\Models\Iuran_Sampah;
use App\Models\Karyawan;
use App\Models\Sampah;
use App\Models\Sampah_Keluar;
use App\Models\Sampah_Kotor;
use App\Models\Sampah_Masuk;
use App\Models\Warga;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menghitung total data
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

        // Menghitung total sampah masuk untuk semua kategori
        $totalSampahMasuk = Sampah::join('sampahmasuk', 'sampah.id_sampah', '=', 'sampahmasuk.id_sampah')
            ->whereIn('kategori', ['Organik', 'Anorganik'])
            ->sum('total_sampahmasuk');

        // Menghitung total sampah masuk per kategori
        $sampahMasukByKategori = Sampah::join('sampahmasuk', 'sampah.id_sampah', '=', 'sampahmasuk.id_sampah')
            ->selectRaw('kategori, SUM(total_sampahmasuk) as total')
            ->whereIn('kategori', ['Organik', 'Anorganik'])
            ->groupBy('kategori')
            ->get();

        // Menghitung persentase untuk setiap kategori
        foreach ($sampahMasukByKategori as $item) {
            $item->percentage = ($totalSampahMasuk > 0) ? ($item->total / $totalSampahMasuk) * 100 : 0;
        }

        // Menghitung total sampah kotor per bulan selama beberapa bulan terakhir
        $sampahKotorBulanan = Sampah_Kotor::selectRaw('DATE_FORMAT(tgl_sampahkotor, "%Y-%m") as month, SUM(total_berat) as total_berat')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Menghitung total sampah masuk per bulan selama beberapa bulan terakhir
        $sampahMasukBulanan = Sampah_Masuk::selectRaw('DATE_FORMAT(tgl_sampahmasuk, "%Y-%m") as month, SUM(total_sampahmasuk) as total_sampahmasuk')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Menggabungkan data sampah kotor dan sampah masuk, serta menghitung selisihnya per bulan
        $dataBulanan = [];
        foreach ($sampahKotorBulanan as $sampahKotor) {
            $matchingMasuk = $sampahMasukBulanan->firstWhere('month', $sampahKotor->month);
            $dataBulanan[] = [
                'month' => $sampahKotor->month,
                'total_berat' => $sampahKotor->total_berat,
                'total_sampahmasuk' => $matchingMasuk ? $matchingMasuk->total_sampahmasuk : 0,
                'selisih' => $sampahKotor->total_berat - ($matchingMasuk ? $matchingMasuk->total_sampahmasuk : 0)
            ];
        }

        // Konversi data ke format yang sesuai untuk Chart.js
        $labels = array_map(function ($month) {
            return Carbon::createFromFormat('Y-m', $month)->translatedFormat('F');
        }, array_column($dataBulanan, 'month'));

        $totalBerat = array_column($dataBulanan, 'total_berat');
        $totalMasuk = array_column($dataBulanan, 'total_sampahmasuk');
        $selisih = array_column($dataBulanan, 'selisih');



        // Menghitung total keseluruhan
        $totalSampahKotor = array_sum($totalBerat);
        $totalSampahMasuk = array_sum($totalMasuk);
        $totalSelisih = array_sum($selisih);

        // Total keseluruhan sampah untuk perhitungan persen
        $totalKeseluruhan = $totalSampahKotor + $totalSampahMasuk + $totalSelisih;

        // Menghitung persentase
        $totalKeseluruhan = $totalSampahKotor + $totalSampahMasuk + $totalSelisih;

        if ($totalKeseluruhan > 0) {
            $persenSampahKotor = ($totalSampahKotor / $totalKeseluruhan) * 100;
            $persenSampahMasuk = ($totalSampahMasuk / $totalKeseluruhan) * 100;
            $persenSelisih = ($totalSelisih / $totalKeseluruhan) * 100;
        } else {
            // Jika total keseluruhan nol, atur persentase ke 0
            $persenSampahKotor = 0;
            $persenSampahMasuk = 0;
            $persenSelisih = 0;
        }



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
            'sampahMasukByKategori',
            'labels',
            'totalBerat',
            'totalMasuk',
            'selisih',
            'persenSampahKotor',
            'persenSampahMasuk',
            'persenSelisih'
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
