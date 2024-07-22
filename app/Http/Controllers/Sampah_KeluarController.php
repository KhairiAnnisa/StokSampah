<?php

namespace App\Http\Controllers;

use App\Models\Sampah_Keluar;
use App\Models\Sampah;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sampah_KeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smph_kel = Sampah_Keluar::with(['sampah'])->get();
        return view('bendahara.tabel_penjualan', compact('smph_kel'));
    }

    /**  
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sampah = Sampah::all();
        return view('smph_kel.create', compact('sampah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_sampahkeluar' => 'required|date',
            'harga_sampahkeluar' => 'required',
            'berat_sampahkeluar' => 'required',
            'total_sampahkeluar' => 'required',
            'jenis' => 'required|in:penjualan_sampah,penjualan_magot',
            'id_sampah' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        Sampah_Keluar::create([
            'tgl_sampahkeluar' => $request->tgl_sampahkeluar,
            'harga_sampahkeluar' => $request->harga_sampahkeluar,
            'berat_sampahkeluar' => $request->berat_sampahkeluar,
            'total_sampahkeluar' => $request->total_sampahkeluar,
            'jenis' => $request->jenis,
            'id_sampah' => $request->id_sampah,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $smph_kel = Sampah_Keluar::whereId($id)->first();
        echo ($smph_kel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Sesuaikan dengan model dan primary key yang digunakan
        $smph_kel = Sampah_Keluar::findOrFail($id);
        $sampah = Sampah::all();
        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $warga ke view
        return view('bendahara.edit_penjualan', compact('smph_kel', 'sampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_sampahkeluar' => 'date',
            'harga_sampahkeluar' => 'integer',
            'berat_sampahkeluar' => 'integer',
            'total_sampahkeluar' => 'integer',
            'jenis' => 'enum',
            'id_sampah' => 'integer',
        ]);

        // Cari data warga berdasarkan ID
        $smph_kel = Sampah_Keluar::findOrFail($id);

        // Update data warga berdasarkan input dari form
        $smph_kel->tgl_sampahkeluar = $request->tgl_sampahkeluar;
        $smph_kel->harga_sampahkeluar = $request->harga_sampahkeluar;
        $smph_kel->berat_sampahkeluar = $request->berat_sampahkeluar;
        $smph_kel->total_sampahkeluar = $request->total_sampahkeluar;
        $smph_kel->jenis = str_replace(' ', '_', strtolower($request->jenis));
        $smph_kel->id_sampah = $request->id_sampah;

        // Simpan perubahan
        $smph_kel->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('smph_kel')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetakPDF()
    {
        $smph_kel = Sampah_Keluar::all();

        $pdf = PDF::loadView('bendahara.cetak_penjualan', compact('smph_kel'));
        return $pdf->download('data_penjualan.pdf');
    }
}
