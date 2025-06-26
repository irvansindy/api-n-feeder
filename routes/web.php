<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NeoFeederController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('auth.login-feeder');
})->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [StudentController::class, 'index'])->name('mahasiswa.index');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('dosen.index');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/check-soap', function () {
    return class_exists('SoapClient') ? 'SOAP aktif' : 'SOAP tidak aktif';
});

Route::get('/feeder/token', [NeoFeederController::class, 'getToken']);
Route::get('/feeder/mahasiswa', [NeoFeederController::class, 'getListMahasiswa']);
Route::post('/insert/mahasiswa', [NeoFeederController::class, 'insertMahasiswa']);
Route::delete('/update/mahasiswa', [NeoFeederController::class, 'updateMahasiswa']);
Route::delete('/delete/mahasiswa', [NeoFeederController::class, 'deleteMahasiswa']);

Route::get('/feeder/prodi', [NeoFeederController::class, 'getProdi']);
// route modul matakuliah
Route::get('/feeder/matakuliah', [NeoFeederController::class, 'getListMatakuliah']);
Route::get('/feeder/detailmatakuliah', [NeoFeederController::class, 'getDetailMatakuliah']);
Route::get('/insert/mataKuliah', [NeoFeederController::class, 'insertMataKuliah']);
Route::get('/update/mataKuliah', [NeoFeederController::class, 'updateMataKuliah']);
Route::get('/delete/mataKuliah', [NeoFeederController::class, 'deleteMataKuliah']);