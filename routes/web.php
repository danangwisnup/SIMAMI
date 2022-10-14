<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;

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

// Home 
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth (login & logout)
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Operator: Add User
Route::get('/operator/add_user', [DashboardController::class, 'add_user'])->middleware('auth', 'operator')->name('user_add');

// Operator: Manajemen User
Route::get('/operator/manajemen_user', [DashboardController::class, 'manajemen_user'])->middleware('auth', 'operator')->name('user_manajemen');

// Operator: CRUD Mahasiswa
Route::resource('/operator/mahasiswa', MahasiswaController::class)->middleware('auth', 'operator');

// Operator: CRUD Dosen
Route::resource('/operator/dosen', DosenController::class)->middleware('auth', 'operator');

// Department: progress studi mahasiswa
route::get('/department/progress_studi_mahasiswa', function () {
    return view('department.progress_studi_mahasiswa', [
        'title' => 'Progress Studi Mahasiswa',
    ]);
});

// Department: data mahasiswa
route::get('/department/data_mahasiswa', function () {
    return view('department.data_mahasiswa', [
        'title' => 'Data Mahasiswa',
    ]);
});

// Department: data dosen
route::get('/department/data_dosen', function () {
    return view('department.data_dosen', [
        'title' => 'Data Dosen',
    ]);
});

// Dosen: progress studi mahasiswa
route::get('/dosen/progress_studi_mahasiswa', function () {
    return view('dosen.progress.index', [
        'title' => 'Progress Studi Mahasiswa',
    ]);
});

// Dosen: verifikasi berkas mahasiswa
route::get('/dosen/verifikasi_berkas_mahasiswa', function () {
    return view('dosen.verifikasi.index', [
        'title' => 'Verifikasi Berkas Mahasiswa',
    ]);
});

// Dosen: data mahasiswa
route::get('/dosen/data_mahasiswa', function () {
    return view('dosen.data_mhs.index', [
        'title' => 'Data Mahasiswa',
    ]);
});

// Dosen: data mahasiswa pkl
route::get('/dosen/data_mahasiswa_pkl', function () {
    return view('dosen.data_pkl.index', [
        'title' => 'Data Mahasiswa PKL',
    ]);
});

// Dosen: data mahasiswa skripsi
route::get('/dosen/data_mahasiswa_skripsi', function () {
    return view('dosen.data_skripsi.index', [
        'title' => 'Data Mahasiswa Skripsi',
    ]);
});