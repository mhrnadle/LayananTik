<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\InfoLayananController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\KategoriSublayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SyaratKategoriController;
use App\Http\Controllers\TrBerkasController;
use App\Http\Controllers\TrPengajuanController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('layanan', KategoriLayananController::class);
    Route::resource('sublayanan', KategoriSublayananController::class);
    Route::resource('syarat', SyaratKategoriController::class);
    Route::get('/layanan/{id}/sublayanan', [KategoriSublayananController::class, 'indexById'])->name('layanan.sublayanan');
    Route::get('/layanan-table', [KategoriLayananController::class, 'layanan'])->name('layanan.table');
    Route::resource('info-layanan', InfoLayananController::class);
    Route::resource('transaksi', TrPengajuanController::class);
    Route::get('/transaksi/syarat/{skl_id}', [TrPengajuanController::class, 'syarat'])->name('transaksi.syarat');
    // Route::resource('berkas', TrBerkasController::class);
    Route::post('/transaksi/uploads', [TrBerkasController::class, 'uploadBerkas'])->name('uploads');
});

Route::resource('/', GuestController::class)->except(['show']);
Route::get('/info/{slug}', [GuestController::class, 'show'])->name('info.show');

require __DIR__ . '/auth.php';
