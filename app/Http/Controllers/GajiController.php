<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data gaji terbaru untuk setiap karyawan
        $gaji = Gaji::select('id_karyawan', \DB::raw('MAX(tgl_gaji) as latest_tgl_gaji'), \DB::raw('MAX(upah) as latest_upah'))
            ->groupBy('id_karyawan')
            ->with('karyawan')
            ->get()
            ->map(function ($item) {
                // Format tanggal hanya untuk menampilkan tanggal saja
                $item->latest_tgl_gaji = \Carbon\Carbon::parse($item->latest_tgl_gaji)->format('Y-m-d');
                return $item;
            });

        // Ambil data karyawan
        $karyawan = Karyawan::all();

        return view('bendahara.tabel_gaji', compact('gaji', 'karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = Karyawan::all();
        return view('gaji.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upah' => 'required',
            'tgl_gaji' => 'required',
            'id_karyawan' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $gaji = Gaji::create([
            'upah' => $request->upah,
            'tgl_gaji' => $request->tgl_gaji,
            'id_karyawan' => $request->id_karyawan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gaji = Gaji::whereId($id)->first();
        echo ($gaji);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gaji = Gaji::findOrFail($id);
        $karyawan = Karyawan::all();

        return view('bendahara.edit_gaji', compact('gaji', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'upah' => 'integer',
            'tgl_gaji' => 'date',
            'id_karyawan' => 'integer',
        ]);

        // Cari data gaji berdasarkan ID
        $gaji = Gaji::findOrFail($id);

        // Update data gaji berdasarkan input dari form
        $gaji->upah = $request->upah;
        $gaji->tgl_gaji = $request->tgl_gaji;
        $gaji->id_karyawan = $request->id_karyawan;


        // Simpan perubahan
        $gaji->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('gaji')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail($id_karyawan)
    {
        $karyawan = Karyawan::findOrFail($id_karyawan);
        $gaji = Gaji::where('id_karyawan', $id_karyawan)->orderBy('tgl_gaji', 'desc')->get();

        return view('bendahara.detail_gaji', compact('karyawan', 'gaji'));
    }
}
