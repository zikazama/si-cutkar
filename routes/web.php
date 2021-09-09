<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Home;
use App\Http\Controllers\Konfigurasi_cuti;
use App\Http\Controllers\Manage_karyawan;
use App\Http\Controllers\Manage_staf_hr;
use App\Http\Controllers\Manage_pengajuan_cuti;
use App\Http\Controllers\Rekap_pengajuan_cuti;

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

Route::get('/', [Login::class,'index']);
Route::get('/login', [Login::class,'index']);
Route::post('/login-action', [Login::class,'login_action']);
Route::get('/logout-action', [Login::class,'logout_action']);

//admin
Route::middleware(['authAdmin'])->prefix('admin')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::resource('/manage-staf-hr', Manage_staf_hr::class);
    Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    Route::resource('/konfigurasi-cuti', Konfigurasi_cuti::class);
    Route::resource('/manage-karyawan', Manage_karyawan::class);
    Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class,'index']);

});

//staf hr
Route::middleware(['authStafHR'])->prefix('staf-hr')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    Route::resource('/konfigurasi-cuti', Konfigurasi_cuti::class);
    Route::resource('/manage-karyawan', Manage_karyawan::class);
    Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class,'index']);

});

//karyawan
Route::middleware(['authKaryawan'])->prefix('karyawan')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::post('/store-pengajuan', [Manage_pengajuan_cuti::class,'store']);
    Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);

});
