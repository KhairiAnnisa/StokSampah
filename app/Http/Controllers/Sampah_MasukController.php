<?php

namespace App\Http\Controllers;

use App\Models\Sampah_Masuk;
use App\Models\Sampah;
use App\Models\Sampah_Kotor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sampah_MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smph_msks = Sampah_Masuk::with(['sampah', 'sampah_kotor'])->get();
        $sampah = Sampah::all();
        $smph_ktr = Sampah_Kotor::all();
        return view('admin.tabel_sampahbersih', compact('smph_msks', 'sampah', 'smph_ktr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sampah = Sampah::all();
        $smph_ktr = Sampah_Kotor::all();
        return view('smph_msk.create', compact('sampah', 'smph_ktr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_sampahmasuk' => 'required|date',
            'total_sampahmasuk' => 'required',
            'id_sampah' => 'required',
            'id_sampahkotor' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $smph_msk = Sampah_Masuk::create([
            'tgl_sampahmasuk' => $request->tgl_sampahmasuk,
            'total_sampahmasuk' => $request->total_sampahmasuk,
            'id_sampah' => $request->id_sampah,
            'id_sampahkotor' => $request->id_sampahkotor,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');

        // echo ($smph_msk);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $smph_msk  = Sampah_Masuk::whereId($id)->first();
        echo ($smph_msk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $smph_msk = Sampah_Masuk::findOrFail($id);
        $sampah = Sampah::all();
        $smph_ktr = Sampah_Kotor::all();

        return view('admin.edit_sampahbersih', compact('smph_msk', 'sampah', 'smph_ktr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_sampahmasuk' => 'date',
            'total_sampahmasuk' => 'integer',
            'id_sampah' => 'integer',
            'id_sampahkotor' => 'integer',
        ]);

        // Cari data warga berdasarkan ID
        $smph_msk = Sampah_Masuk::findOrFail($id);

        // Update data warga berdasarkan input dari form
        $smph_msk->tgl_sampahmasuk = $request->tgl_sampahmasuk;
        $smph_msk->total_sampahmasuk = $request->total_sampahmasuk;
        $smph_msk->id_sampah = $request->id_sampah;
        $smph_msk->id_sampahkotor = $request->id_sampahkotor;

        // Simpan perubahan
        $smph_msk->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('smph_msk')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
