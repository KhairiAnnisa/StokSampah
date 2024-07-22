<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cost = Cost::orderBy("tgl_cost", 'desc')->paginate(100);
        return view('bendahara.tabel_cost', compact('cost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cost.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengeluaran' => 'required',
            'biaya' => 'required',
            'tgl_cost' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $cost = Cost::create([
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'biaya' => $request->biaya,
            'tgl_cost' => $request->tgl_cost,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cost = Cost::whereId($id)->first();
        echo ($cost);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cost = Cost::findOrFail($id); // Sesuaikan dengan model dan primary key yang digunakan

        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $cost ke view
        return view('bendahara.edit_cost', compact('cost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pengeluaran' => 'string',
            'biaya' => 'integer',
            'tgl_cost' => 'date',
        ]);

        // Cari data cost berdasarkan ID
        $cost = Cost::findOrFail($id);

        // Update data cost berdasarkan input dari form
        $cost->nama_pengeluaran = $request->nama_pengeluaran;
        $cost->biaya = $request->biaya;
        $cost->tgl_cost = $request->tgl_cost;

        // Simpan perubahan
        $cost->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('cost')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
