<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil daftar unik alamat, rt, dan rw
        $alamatList = Warga::select('alamat')->distinct()->get();
        $rtList = Warga::select('rt')->distinct()->get();
        $rwList = Warga::select('rw')->distinct()->get();

        // Membuat query builder untuk data warga
        $query = Warga::query();

        // Filter berdasarkan request jika ada
        if ($request->has('alamat') && $request->alamat != '') {
            $query->where('alamat', $request->alamat);
        }
        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }
        if ($request->has('rw') && $request->rw != '') {
            $query->where('rw', $request->rw);
        }

        // Mengambil data warga berdasarkan query yang sudah difilter
        $warga = $query->orderBy('tgl_warga', 'desc')->paginate(100);

        // Mengembalikan view 'warga.index' beserta data yang diperlukan
        return view('admin.tabel_warga', compact('warga', 'alamatList', 'rtList', 'rwList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_warga' => 'required',
            'no_hp_warga' => 'required|numeric',
            'blok' => 'required',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required',
            'rw' => 'required',

        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $warga = Warga::create([
            'nama_warga' => $request->nama_warga,
            'no_hp_warga' => $request->no_hp_warga,
            'blok' => $request->blok,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'rw' => $request->rw,

        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warga = Warga::find($id);
        if (!$warga) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json($warga);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warga = Warga::findOrFail($id); // Sesuaikan dengan model dan primary key yang digunakan

        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $warga ke view
        return view('admin.edit_warga', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_warga' => 'string',
            'no_hp_warga' => 'string',
            'blok' => 'string',
            'alamat' => 'string',
            'kelurahan' => 'string',
            'kecamatan' => 'string',
            'rt' => 'int',
            'rw' => 'int',
        ]);

        // Cari data warga berdasarkan ID
        $warga = Warga::findOrFail($id);

        // Update data warga berdasarkan input dari form
        $warga->nama_warga = $request->nama_warga;
        $warga->no_hp_warga = $request->no_hp_warga;
        $warga->blok = $request->blok;
        $warga->alamat = $request->alamat;
        $warga->kelurahan = $request->kelurahan;
        $warga->kecamatan = $request->kecamatan;
        $warga->rt = $request->rt;
        $warga->rw = $request->rw;

        // Simpan perubahan
        $warga->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('warga')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetakPDF(Request $request)
    {
        $query = Warga::query();

        if ($request->filled('alamat')) {
            $query->where('alamat', 'like', '%' . $request->input('alamat') . '%');
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->input('rt'));
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->input('rw'));
        }

        $warga = $query->get();

        $pdf = PDF::loadView('admin.cetak_warga', compact('warga'));
        return $pdf->download('data_warga.pdf');
    }
}
