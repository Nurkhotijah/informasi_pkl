<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PengajuanSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JurnalAdminController;
use App\Http\Controllers\JurnalIndustriController;
use App\Http\Controllers\JurnalSiswaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SekolahController;


Route::get('/', function () {
    return view('welcome');
});

// Route login
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', function () {
    return view('auth.register');  // Menampilkan halaman registrasi
})->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
// // Route lupa password 
// Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// INDUSTRI

Route::get('/dashboard-industri', [IndustriController::class, 'dashboard'])->name('industri.dashboard');

Route::get('/update-industri', [IndustriController::class, 'updateIndustri'])->name('update-industri');

Route::get('/kelola-kehadiran', [IndustriController::class, 'kehadiran'])->name('kelola-kehadiran');
Route::post('/kehadiran/update/{id}', [IndustriController::class, 'update'])->name('kehadiran.update');
Route::get('/kehadiran/edit/{id}', [IndustriController::class, 'edit'])->name('kehadiran.edit');

Route::get('/kehadiran-siswa', [IndustriController::class, 'kehadiranSiswa'])->name('kehadiran-siswa');


Route::get('/profile-industri', [IndustriController::class, 'profileIndustri'])->name('profile-industri');

Route::get('/pages-industri/edit-pengajuan/{id}', function ($id) {
    return view('pages-industri.edit-pengajuan', compact('id'));
})->name('edit-pengajuan');


Route::get('/pages-industri/edit-kehadiran/{id}', function ($id) {
    return view('pages-industri.edit-kehadiran', compact('id'));
})->name('edit-kehadiran');

Route::get('/pages-industri/tambah-kehadiran/{id}', function ($id) {
    return view('pages-industri.tambah-kehadiran', compact('id'));
})->name('tambah-kehadiran');

Route::get('/pages-industri/cetak-rekap/{id}', function ($id) {
    return view('pages-industri.cetak-rekap', compact('id'));
})->name('cetak-rekap');

Route::get('/pages-industri/edit-rekap/{id}', function ($id) {
    return view('pages-industri.edit-rekap', compact('id'));
})->name('edit-rekap');

Route::get('/pages-industri/tambah-rekap/{id}', function ($id) {
    return view('pages-industri.tambah-rekap', compact('id'));
})->name('tambah-rekap');

Route::get('/pages-industri/lihat-rekap/{id}', function ($id) {
    return view('pages-industri.lihat-rekap', compact('id'));
})->name('lihat-rekap');

Route::get('/pages-industri/hapus-rekap/{id}', function ($id) {
    return view('pages-industri.hapus-rekap', compact('id'));
})->name('hapus-rekap');


// ADMIN

Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Rute untuk mengelola kehadiran
Route::get('kehadiran-siswapkl', [AdminController::class, 'index'])->name('kehadiran-siswapkl');

Route::get('pengajuan-siswa', [SiswaController::class, 'index'])->name('pengajuan-siswa');
Route::get('tambah-siswa', [SiswaController::class, 'create'])->name('tambah-siswa');
Route::post('pengajuan-siswa', [SiswaController::class, 'store'])->name('pengajuan-siswa.store');
Route::delete('hapus-siswa/{id}', [SiswaController::class, 'destroy'])->name('hapus-siswa');
/* -------------------------------------------------------------------------- */
/*                                  INDUSTRI                                  */
/* -------------------------------------------------------------------------- */

Route::prefix('sekolah')->name('sekolah.')->group(function () {
    Route::get('', [SekolahController::class, 'index'])->name('index');
    Route::get('/detail-siswa/{id}', [SekolahController::class, 'detailSiswa'])->name('detail-siswa');
    Route::post('/update-status-siswa', [SekolahController::class, 'updateStatusSiswa'])->name('update-status-siswa');
});
Route::get('lihat-detail', [IndustriController::class, 'lihatdetail'])->name('lihat-detail');


Route::prefix('jurnal-industri')->name('jurnal-industri.')->group(function () {
    Route::get('', [JurnalIndustriController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [JurnalIndustriController::class, 'show'])->name('detail');
});


/* -------------------------------------------------------------------------- */
/*                                END INDUSTRI                                */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                   SEKOLAH                                  */
/* -------------------------------------------------------------------------- */

Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
    Route::get('', [PengajuanController::class, 'index'])->name('index');
    Route::get('/create', [PengajuanController::class, 'create'])->name('create');
    Route::post('/store', [PengajuanController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [PengajuanController::class, 'destroy'])->name('delete');
});
Route::get('pengajuan-index', [AdminController::class, 'pengajuanindex'])->name('pengajuan-index');
Route::get('lihat-siswa', [AdminController::class, 'lihatsiswa'])->name('lihat-siswa');


Route::prefix('jurnal-admin')->name('jurnal-admin.')->group(function () {
    Route::get('', [JurnalAdminController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [JurnalAdminController::class, 'show'])->name('detail');
});


/* -------------------------------------------------------------------------- */
/*                                 END SEKOLAH                                */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                    SISWA                                   */
/* -------------------------------------------------------------------------- */

Route::prefix('jurnal-siswa')->name('jurnal-siswa.')->group(function () {
    Route::get('', [JurnalSiswaController::class, 'index'])->name('index');
    Route::get('/create', [JurnalSiswaController::class, 'create'])->name('create');
    Route::post('/store', [JurnalSiswaController::class, 'store'])->name('store');
    Route::get('/{id}', [JurnalSiswaController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [JurnalSiswaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [JurnalSiswaController::class, 'update'])->name('update');
    Route::delete('/{id}', [JurnalSiswaController::class, 'destroy'])->name('destroy');
    Route::post('/upload/{id}', [JurnalSiswaController::class, 'uploadLaporan'])->name('upload');
});

/* -------------------------------------------------------------------------- */
/*                                  END SISWA                                 */
/* -------------------------------------------------------------------------- */

Route::get('/data-siswa', [AdminController::class, 'dataSiswa'])->name('data-siswa');

// Route::get('/tambah-siswa', [AdminController::class, 'tambahSiswa'])->name('tambah-siswa');

Route::get('/nilai-siswa', [AdminController::class, 'nilaiSiswa'])->name('nilai-siswa');

Route::get('/', [KehadiranController::class, 'index'])->name('kehadiran'); // Menampilkan daftar kehadiran
Route::get('edit/{id}', [KehadiranController::class, 'edit'])->name('edit'); // Halaman edit kehadiran
Route::post('update/{id}', [KehadiranController::class, 'update'])->name('updatekehadiran'); // Update data kehadiran

Route::get('/profile-admin', [ProfileController::class, 'showprofilesekolah'])->name('profile-admin');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');


// USER
Route::post('/laporan-pkl', [LaporanController::class, 'store'])->name('laporan.store');

Route::get('/riwayat-absensi', [KehadiranController::class, 'index'])->name('riwayat-absensi');
Route::post('/kehadiran/store', [KehadiranController::class, 'store'])->name('kehadiran.store');
Route::get('/dashboard-user', [UserController::class, 'dashboard'])->name('user.dashboard');


Route::get('/riwayat-absensi', [KehadiranController::class, 'index'])->name('riwayat-absensi');
Route::post('/upload-foto-izin', [KehadiranController::class, 'uploadFotoIzin'])->name('uploadFotoIzin');
Route::get('/unduh-rekap', [KehadiranController::class, 'downloadRekap'])->name('downloadRekap');

Route::get('/laporan-pkl', [UserController::class, 'laporanpkl'])->name('laporan-pkl');


Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::get('/update-profile', [ProfileController::class, 'edit'])->name('profile.update');


// Route untuk mengganti kata sandi
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');