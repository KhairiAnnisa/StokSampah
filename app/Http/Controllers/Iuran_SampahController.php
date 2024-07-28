<?php

namespace App\Http\Controllers;

use App\Models\Iuran_Sampah;
use App\Models\Warga;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Iuran_SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iuran = Iuran_Sampah::with(['warga'])->get();
        $warga = Warga::all();
        return view('bendahara.tabel_iuransampah', compact('iuran', 'warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::all();
        return view('iuran.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required',
            'tgl_iuransampah' => 'required|date',
            'status' => 'required|in:lunas,belum_lunas',
            'harga' => 'required|integer',
            'id_warga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data baru ke dalam tabel
        Iuran_Sampah::create([
            'bulan' => $request->bulan,
            'tgl_iuransampah' => $request->tgl_iuransampah,
            'status' => $request->status,
            'harga' => $request->harga,
            'id_warga' => $request->id_warga,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $iuran = Iuran_Sampah::findOrFail($id);
        $warga = Warga::all();
        return view('bendahara.edit_iuransampah', compact('iuran', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'string',
            'tgl_iuransampah' => 'date',
            'status' => 'required|in:lunas,belum_lunas',
            'harga' => 'integer',
            'id_warga' => 'integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find iuran by ID
        $iuran = Iuran_Sampah::findOrFail($id);

        // Update iuran data
        $iuran->update([
            'bulan' => $request->bulan,
            'tgl_iuransampah' => $request->tgl_iuransampah,
            'status' => $request->status,
            'harga' => $request->harga,
            'id_warga' => $request->id_warga,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('iuran')->with('success', 'Data Iuran Sampah berhasil diperbarui.');
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
        $iuran = Iuran_Sampah::all();

        $pdf = PDF::loadView('bendahara.cetak_iuransampah', compact('iuran'));
        return $pdf->download('data_iuransampah.pdf');
    }
}
