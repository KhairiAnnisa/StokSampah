<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Sampah_Kotor;
use App\Models\Sampah_Masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Sampah_KotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smph_ktr = Sampah_Kotor::with(['rute'])->get();
        $rute = Rute::all();
        return view('admin.tabel_sampahkotor', compact('smph_ktr', 'rute'));

        // try {
        //     $smph_ktr = Sampah_Kotor::with('rute')->paginate(10);

        //     // Check if the result is valid
        //     if ($smph_ktr === false) {
        //         // Handle the error appropriately
        //         return response()->json(['error' => 'Query failed'], 500);
        //     }
        //     // var_dump($smph_ktr);
        //     return view('admin.tabel_sampahkotor', compact('smph_ktr'));
        // } catch (\Exception $e) {
        //     // Log the error or handle it as needed
        //     Log::error($e->getMessage());
        //     return response()->json(['error' => 'An error occurred'], 50);
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rute = Rute::all();
        return view('smph_ktr.create', compact('rute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_sampahkotor' => 'required',
            'total_berat' => 'required',
            'id_rute' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $smph_ktr = Sampah_Kotor::create([
            'tgl_sampahkotor' => $request->tgl_sampahkotor,
            'total_berat' => $request->total_berat,
            'id_rute' => $request->id_rute,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');

        // $validator = Validator::make($request->all(), [
        //     'tgl_sampahkotor' => 'required|date',
        //     'total_berat' => 'required|numeric',
        //     'id_rute' => 'required|integer',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // // Buat entri baru Sampah Kotor
        // $smph_ktr = Sampah_Kotor::create([
        //     'tgl_sampahkotor' => $request->tgl_sampahkotor,
        //     'total_berat' => $request->total_berat,
        //     'id_rute' => $request->id_rute,
        // ]);

        // // Temukan atau buat Sampah Masuk yang sesuai untuk tanggal yang sama
        // $smph_msk = Sampah_Masuk::firstOrCreate(
        //     ['tgl_sampahmasuk' => $request->tgl_sampahkotor],
        //     ['id_sampahkotor' => $smph_ktr->id, 'total_sampahmasuk' => 0]
        // );

        // // Perbarui total_sampahmasuk pada Sampah Masuk
        // $smph_msk->total_sampahmasuk += $request->total_berat;
        // $smph_msk->id_sampahkotor = $smph_ktr->id;
        // $smph_msk->save();

        // // Kurangi total_berat di Sampah Kotor
        // $smph_ktr->total_berat -= $request->total_berat;
        // $smph_ktr->save();

        // return redirect()->back()->with('success', 'Data Sampah Kotor berhasil ditambahkan dan terkait dengan Sampah Masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $smph_ktr = Sampah_Kotor::whereId($id)->first();
        echo ($smph_ktr);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Sesuaikan dengan model dan primary key yang digunakan
        $smph_ktr = Sampah_Kotor::findOrFail($id);
        $rute = Rute::all();
        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $warga ke view
        return view('admin.edit_sampahkotor', compact('smph_ktr', 'rute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_sampahkotor' => 'date',
            'total_berat' => 'integer',
            'id_rute' => 'integer',
        ]);

        // Cari data warga berdasarkan ID
        $smph_ktr = Sampah_Kotor::findOrFail($id);

        // Update data warga berdasarkan input dari form
        $smph_ktr->tgl_sampahkotor = $request->tgl_sampahkotor;
        $smph_ktr->total_berat = $request->total_berat;
        $smph_ktr->id_rute = $request->id_rute;

        // Simpan perubahan
        $smph_ktr->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('smph_ktr')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
