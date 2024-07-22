<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sampah = Sampah::orderBy("tgl_sampah", 'desc')->paginate(100);
        return view('admin.tabel_stoksampah', compact('sampah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sampah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sampah' => 'required',
            'stok_sampah' => 'required',
            'kategori' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $sampah = Sampah::create([
            'nama_sampah' => $request->nama_sampah,
            'stok_sampah' => $request->stok_sampah,
            'kategori' => $request->kategori,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sampah = Sampah::whereId($id)->first();
        echo ($sampah);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Sesuaikan dengan model dan primary key yang digunakan
        $sampah = Sampah::findOrFail($id); 

        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $warga ke view
        return view('admin.edit_stoksampah', compact('sampah'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_sampah' => 'string',
            'stok_sampah' => 'integer',
            'kategori' => 'string',
        ]);

        // Cari data warga berdasarkan ID
        $sampah = Sampah::findOrFail($id);

        // Update data warga berdasarkan input dari form
        $sampah->nama_sampah = $request->nama_sampah;
        $sampah->stok_sampah = $request->stok_sampah;
        $sampah->kategori = $request->kategori;

        // Simpan perubahan
        $sampah->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('sampah')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
