<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::orderBy("tgl_karyawan", 'desc')->paginate(100);
        return view('admin.tabel_karyawan', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_karyawan' => 'required',
            'alamat' => 'required',
            'posisi' => 'required',
            'no_hp' => 'required',
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }

        // Simpan data baru ke dalam tabel
        $karyawan = Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'alamat' => $request->alamat,
            'posisi' => $request->posisi,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $karyawan = Karyawan::whereId($id)->first();
        echo ($karyawan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = Karyawan::findOrFail($id); // Sesuaikan dengan model dan primary key yang digunakan

        // Jika menggunakan form model binding, Anda bisa langsung mengirimkan $karyawan ke view
        return view('admin.edit_karyawan', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_karyawan' => 'string',
            'alamat' => 'string',
            'posisi' => 'string',
            'no_hp' => 'string',
        ]);

        // Cari data karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);

        // Update data karyawan berdasarkan input dari form
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->alamat = $request->alamat;
        $karyawan->posisi = $request->posisi;
        $karyawan->no_hp = $request->no_hp;

        // Simpan perubahan
        $karyawan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('karyawan')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
