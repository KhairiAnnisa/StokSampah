<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rute = Rute::orderBy("tgl_rute", 'desc')->paginate(100);
        return view('admin.tabel_rute', compact('rute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rute' => 'required',
            'detail_rute' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $rute = Rute::create([
            'nama_rute' => $request->nama_rute,
            'detail_rute' => $request->detail_rute,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rute = Rute::find($id);
        if (!$rute) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($rute);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rute = Rute::findOrFail($id); // Sesuaikan dengan model dan primary key yang digunakan

        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $warga ke view
        return view('admin.edit_rute', compact('rute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_rute' => 'string',
            'detail_rute' => 'string',
        ]);

        // Cari data warga berdasarkan ID
        $rute = Rute::findOrFail($id);

        // Update data warga berdasarkan input dari form
        $rute->nama_rute = $request->nama_rute;
        $rute->detail_rute = $request->detail_rute;

        // Simpan perubahan
        $rute->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('rute')->with('success', 'Data Rute berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
