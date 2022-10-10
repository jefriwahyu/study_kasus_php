<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Barang;
use App\Http\Controllers\Pertanyaan;
use App\Http\Controllers\Akun;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/pushData', [Barang::class, 'store']);
Route::get('/getData', [Barang::class, 'getData']);
Route::get('/hapus/{id}', [Barang::class, 'hapus']);
Route::get('/getDetail/{id}', [Barang::class, 'getDetail']);
Route::post('/updateData', [Barang::class, 'update']);
Route::post('/pertanyaan', [Pertanyaan::class, 'pertanyaan']);
Route::post('/jawaban', [Pertanyaan::class, 'jawaban']);
Route::post('/tambahAkun', [Akun::class, 'tambah']);
Route::post('/ubahData', [Akun::class, 'ubah']);
Route::get('/getUser/{username}', [Akun::class, 'Detail']);