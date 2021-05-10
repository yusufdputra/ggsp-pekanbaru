<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\EntriAgenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PeringkatController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'auth'])->name('/');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// get kabupaten
Route::get('/GetKabupaten/{id}', [DaerahController::class, 'GetKabupaten'])->name('GetKabupaten');
Route::get('/GetKecamatan/{id}', [DaerahController::class, 'GetKecamatan'])->name('GetKecamatan');
Route::get('/GetKelurahan/{id}', [DaerahController::class, 'GetKelurahan'])->name('GetKelurahan');
// admin

Route::group(['middleware' => ['role:admin']], function () {

    // kelola agen
    Route::get('/agen/', [AgenController::class, 'index'])->name('agen.index');
    Route::get('/agen/tambah', [AgenController::class, 'tambah'])->name('agen.tambah');
    Route::post('/agen/store', [AgenController::class, 'store'])->name('agen.store');
    Route::get('/agen/edit/{id}', [AgenController::class, 'edit'])->name('agen.edit');
    Route::post('/agen/update', [AgenController::class, 'update'])->name('agen.update');
    Route::post('/agen/hapus', [AgenController::class, 'hapus'])->name('agen.hapus');
    Route::post('/agen/resetpw', [AgenController::class, 'resetpw'])->name('agen.resetpw');

    // kelola sales
    Route::get('/sales/{jenis}', [SalesController::class, 'index'])->name('sales.index');
    Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
    Route::post('/sales/edit', [SalesController::class, 'edit'])->name('sales.edit');
    Route::post('/sales/update', [SalesController::class, 'update'])->name('sales.update');
    Route::post('/sales/hapus', [SalesController::class, 'hapus'])->name('sales.hapus');
    Route::post('/sales/resetpw', [SalesController::class, 'resetpw'])->name('sales.resetpw');

    // kelola barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::post('/barang/update', [BarangController::class, 'update'])->name('barang.update');
    Route::post('/barang/hapus', [BarangController::class, 'hapus'])->name('barang.hapus');

    // kehadiran
    Route::get('/pembelian/{id}', [PembelianController::class, 'pembelian'])->name('pembelian.history');
    
});

Route::group(['middleware' => ['role:sales']], function () {
    Route::get('/entri', [EntriAgenController::class, 'index'])->name('entri.index');
    Route::get('/entri/tambah', [EntriAgenController::class, 'tambah'])->name('entri.tambah');
    Route::post('/entri/store', [EntriAgenController::class, 'store'])->name('entri.store');


    Route::get('/GetAgen/{id}', [AgenController::class, 'GetAgen'])->name('GetAgen');
    Route::get('/GetAgenById/{id}', [AgenController::class, 'GetAgenById'])->name('GetAgenById');
});

Route::group(['middleware' => ['role:|agen']], function () {
    // kelola pembelian
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::get('/pembelian/tambah/{id}', [PembelianController::class, 'tambah'])->name('pembelian.tambah');
    Route::post('/pembelian/store/', [PembelianController::class, 'store'])->name('pembelian.store');
});
Route::group(['middleware' => ['role:sales|admin|agen']], function () {
    // kelola peringkat
    Route::get('/peringkat', [PeringkatController::class, 'index'])->name('peringkat.index');
});

Route::group(['middleware' => ['role:sales|admin']], function () {

    // kehadiran
    Route::get('/kehadiran', [KehadiranController::class, 'index'])->name('kehadiran.index');

});