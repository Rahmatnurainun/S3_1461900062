<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

// Route::get('/', function () {
//     return view('buku0048');
// });

Route::get('/',  [BukuController::class, 'index']);
Route::get('/buku/cari', [BukuController::class, 'search']);
Route::get('/buku/tambah', [BukuController::class, 'tambah']);
Route::post('/buku/store', [BukuController::class, 'store']);
Route::get('/buku/hapus/{id}', [BukuController::class, 'hapus']);
Route::get('/buku/edit/{id}', [BukuController::class, 'edit']);
// Route::resource('buku', BukuController::class);
