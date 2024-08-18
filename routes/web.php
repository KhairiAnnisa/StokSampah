<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\Iuran_SampahController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\Laporan_LabaRugiController;
use App\Http\Controllers\Laporan_PemasukanController;
use App\Http\Controllers\Laporan_PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\Sampah_KeluarController;
use App\Http\Controllers\Sampah_KotorController;
use App\Http\Controllers\Sampah_MasukController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\WargaController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route bisa diakses jika sudah melakukan login
Route::get('/test', [AuthController::class, 'test'])->name('test');
Route::get('/token', [AuthController::class, 'token'])->name('token');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/auth/register', function () {
    return view('auth.register');
});
Route::get('/dashboard', [BerandaController::class, 'index'])->name('dashboard.index');

// Route::group(['middleware' => ['auth', 'hakakses:admin,bendahara,ketua']], function () {
//     route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
// });

Route::post('/warga', [WargaController::class, 'store'])->name('store');
Route::get('/warga/{id}', [WargaController::class, 'show']);
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::get('/tabel_warga', [WargaController::class, 'index'])->name('warga');
Route::get('/cetak_warga', [WargaController::class, 'cetakPDF'])->name('warga.cetak');

Route::post('/iuran_sampah', [Iuran_SampahController::class, 'store'])->name('store');
Route::get('/iuran_sampah/{id}', [Iuran_SampahController::class, 'show']);
Route::get('/iuran_sampah/{id}/edit', [Iuran_SampahController::class, 'edit'])->name('iuran.edit');
Route::put('/iuran_sampah/{id}', [Iuran_SampahController::class, 'update'])->name('iuran.update');
Route::get('/tabel_iuransampah', [Iuran_SampahController::class, 'index'])->name('iuran');
Route::get('/cetak_iuransampah', [Iuran_SampahController::class, 'cetakPDF'])->name('iuransampah.cetak');
Route::get('/iuran-sampah/detail/{id_warga}', [Iuran_SampahController::class, 'detail'])->name('iuran.detail');



Route::post('/sampah', [SampahController::class, 'store'])->name('store');
Route::get('/sampah/{id}', [SampahController::class, 'show']);
Route::get('/sampah/{id}/edit', [SampahController::class, 'edit'])->name('sampah.edit');
Route::put('/sampah/{id}', [SampahController::class, 'update'])->name('sampah.update');
Route::get('/tabel_stoksampah', [SampahController::class, 'index'])->name('sampah');

Route::post('/smph_msk', [Sampah_MasukController::class, 'store'])->name('store');
Route::get('/smph_msk/{id}', [Sampah_MasukController::class, 'show']);
Route::get('/smph_msk/{id}/edit', [Sampah_MasukController::class, 'edit'])->name('smph_msk.edit');
Route::put('/smph_msk/{id}', [Sampah_MasukController::class, 'update'])->name('smph_msk.update');
Route::get('/tabel_sampahbersih', [Sampah_MasukController::class, 'index'])->name('smph_msk');

Route::post('/smph_kel', [Sampah_KeluarController::class, 'store'])->name('store');
Route::get('/smph_kel/{id}', [Sampah_KeluarController::class, 'show']);
Route::get('/smph_kel/{id}/edit', [Sampah_KeluarController::class, 'edit'])->name('smph_kel.edit');
Route::put('/smph_kel/{id}', [Sampah_KeluarController::class, 'update'])->name('smph_kel.update');
Route::get('/tabel_penjualan', [Sampah_KeluarController::class, 'index'])->name('smph_kel');
Route::get('/cetak_penjualan', [Sampah_KeluarController::class, 'cetakPDF'])->name('smph_kel.cetak');

Route::post('/cost', [CostController::class, 'store'])->name('store');
Route::get('/cost/{id}', [CostController::class, 'show']);
Route::get('/cost/{id}/edit', [CostController::class, 'edit'])->name('cost.edit');
Route::put('/cost/{id}', [CostController::class, 'update'])->name('cost.update');
Route::get('/tabel_cost', [CostController::class, 'index'])->name('cost');

Route::post('/gaji', [GajiController::class, 'store'])->name('gaji.store');
Route::get('/gaji/{id}', [GajiController::class, 'show']);
Route::get('/gaji/{id}/edit', [GajiController::class, 'edit'])->name('gaji.edit');
Route::put('/gaji/{id}', [GajiController::class, 'update'])->name('gaji.update');
Route::get('/tabel_gaji', [GajiController::class, 'index'])->name('gaji.index');
Route::get('gaji/{id_karyawan}/detail', [GajiController::class, 'detail'])->name('gaji.detail');

Route::post('/karyawan', [KaryawanController::class, 'store'])->name('store');
Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::get('/tabel_karyawan', [KaryawanController::class, 'index'])->name('karyawan');

Route::post('/rute', [RuteController::class, 'store'])->name('store');
Route::get('/rute/{id}', [RuteController::class, 'show']);
Route::get('/rute/{id}/edit', [RuteController::class, 'edit'])->name('rute.edit');
Route::put('/rute/{id}', [RuteController::class, 'update'])->name('rute.update');
Route::get('/tabel_rute', [RuteController::class, 'index'])->name('rute');

Route::post('/smph_ktr', [Sampah_KotorController::class, 'store'])->name('store');
Route::get('/smph_ktr/{id}', [Sampah_KotorController::class, 'show']);
Route::get('/smph_ktr/{id}/edit', [Sampah_KotorController::class, 'edit'])->name('smph_ktr.edit');
Route::put('/smph_ktr/{id}', [Sampah_KotorController::class, 'update'])->name('smph_ktr.update');
Route::get('/tabel_sampahkotor', [Sampah_KotorController::class, 'index'])->name('smph_ktr');


Route::get('/tabel_laporan', [LaporanController::class, 'generateReport'])->name('generateReport');
Route::get('/cetak_laporan', [LaporanController::class, 'cetak'])->name('report.cetak');

Route::get('/laporanpemasukan', [Laporan_PemasukanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [Laporan_PemasukanController::class, 'cetak'])->name('laporan.cetak');

Route::get('laporanpengeluaran', [Laporan_PengeluaranController::class, 'index'])->name('laporan.pengeluaran');
Route::get('laporanpengeluaran/cetak', [Laporan_PengeluaranController::class, 'cetak'])->name('laporan.pengeluaran.cetak');

Route::get('/laporan_labarugi', [Laporan_LabaRugiController::class, 'labaRugiIndex'])->name('laporan.laba_rugi_index');
Route::get('/laporan/laba-rugi/{year}', [Laporan_LabaRugiController::class, 'labaRugiDetail'])->name('laporan.laba_rugi_detail');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
