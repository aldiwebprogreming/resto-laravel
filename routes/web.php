<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Resto;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [Admin::class, 'index']);
Route::get('makanan', [Admin::class, 'makanan']);
Route::post('admin/act_makanan', [Admin::class, 'act_makanan']);
Route::delete('admin/hapus_food', [Admin::class, 'hapus_food']);
Route::put('admin/act_edit_food/{id}', [Admin::class, 'act_edit_food']);

Route::get("minuman", [Admin::class, 'minuman']);
Route::post('admin/act_minuman', [Admin::class, 'act_minuman']);
Route::delete('admin/hapus_drink', [Admin::class, 'hapus_drink']);
Route::put('admin/act_edit_drink/{id}', [Admin::class, 'act_edit_drink']);

Route::get('cemilan', [Admin::class, 'cemilan']);
Route::post('admin/act_cemilan', [Admin::class, 'act_cemilan']);
Route::delete('admin/hapus_snacks', [Admin::class, 'hapus_snacks']);
Route::put('admin/act_edit_snacks/{id}', [Admin::class, 'act_edit_snacks']);

Route::get('pegawai', [Admin::class, 'pegawai']);
Route::post('admin/act_pegawai', [Admin::class, 'act_pegawai']);
Route::delete('admin/hapus_pegawai', [Admin::class, 'hapus_pegawai']);
Route::put('admin/act_edit_pegawai/{id}', [Admin::class, 'act_edit_pegawai']);

Route::get('/admin', [Admin::class, 'data_admin']);
Route::post('admin/add_admin', [Admin::class, 'add_admin']);
Route::delete('admin/hapus_admin', [Admin::class, 'hapus_admin']);

Route::get('meja', [Admin::class, 'meja']);
Route::post('admin/act_meja', [Admin::class, 'act_meja']);


// Resto
Route::get('resto/', [Resto::class, 'index']);
Route::post('resto/add_customer', [Resto::class, 'add_customer']);
Route::get('hapus', [Resto::class, 'hapus']);
Route::post('resto/add_keranjang', [Resto::class, 'add_keranjang']);
Route::post('resto/act_pesanan', [Resto::class, 'act_pesanan']);
Route::get('resto/hapus_cart/{id}', [Resto::class, 'hapus_cart']);
// Endresto