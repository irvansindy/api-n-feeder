<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NeoFeederController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/check-soap', function () {
    return class_exists('SoapClient') ? 'SOAP aktif' : 'SOAP tidak aktif';
});

Route::get('/feeder/token', [NeoFeederController::class, 'getToken']);
Route::get('/feeder/mahasiswa', [NeoFeederController::class, 'getListMahasiswa']);
Route::post('/insert/mahasiswa', [NeoFeederController::class, 'insertMahasiswa']);
Route::delete('/update/mahasiswa', [NeoFeederController::class, 'updateMahasiswa']);
Route::delete('/delete/mahasiswa', [NeoFeederController::class, 'deleteMahasiswa']);
