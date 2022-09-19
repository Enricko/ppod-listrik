<?php

use App\Http\Controllers\HomeController;
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
// Random Route
Auth::routes();
Route::get('/error',[App\Http\Controllers\Frontend::class,'error']);

//Route User
Route::get('/',[App\Http\Controllers\Frontend::class,'index']);
Route::post('/payment_confirm',[App\Http\Controllers\Bayar::class,'payment_confirm']);
Route::get('/bayar/bca',[App\Http\Controllers\Bayar::class,'bca']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'pelangganHome'])->name('home');

//Route Admin
Route::prefix('admin')->middleware(['auth','user-level'])->group(function(){
    Route::get('/home',[HomeController::class,'administrasiHome'])->name('home');
    Route::get('/',[App\Http\Controllers\Admin::class,'index']);
    Route::post('/',[App\Http\Controllers\Admin::class,'index']);
    Route::post('/laporan',[App\Http\Controllers\Admin::class,'laporan']);
    // == User ==
    Route::get('/user',[App\Http\Controllers\Admin::class,'user']);
    // == Tagihan ==
    Route::get('/tagihan',[App\Http\Controllers\Tagihans::class,'tagihan']);
    Route::get('/tagihan_tambah',[App\Http\Controllers\Tagihans::class,'tambah']);
    Route::post('/tagihan/insert',[App\Http\Controllers\Tagihans::class,'insert']);
    Route::get('/tagihan/edit/{id_tagihan}',[App\Http\Controllers\Tagihans::class,'edit']);
    Route::post('/tagihan/update/{id_penggunaan}',[App\Http\Controllers\Tagihans::class,'update']);
    Route::get('/tagihan/delete/{id_tagihan}/{id_penggunaan}',[App\Http\Controllers\Tagihans::class,'delete']);
    Route::get('/tagihan/payment_confirm/{id_tagihan}',[App\Http\Controllers\Tagihans::class,'payment_confirm']);
    
    // == Pembayaran ==
    Route::get('/pembayaran',[App\Http\Controllers\Pembayarans::class,'pembayaran']);
    Route::get('/pembayaran/keliru/{id_tagihan}/{paid_in}',[App\Http\Controllers\Pembayarans::class,'keliru']);
    
});

//Route Bank
Route::prefix('bank')->middleware(['auth','bank-level'])->group(function(){
    Route::get('/home',[HomeController::class,'bankHome'])->name('home');
    
    Route::post('/',[App\Http\Controllers\Admin::class,'index']);
    Route::post('/laporan',[App\Http\Controllers\Admin::class,'laporan']);
    Route::get('/',[App\Http\Controllers\Admin::class,'index']);
    
    // Tagihan
    Route::get('/tagihan',[App\Http\Controllers\Tagihans::class,'tagihan']);
    Route::get('/tagihan_tambah',[App\Http\Controllers\Tagihans::class,'tambah']);
    Route::post('/tagihan/insert',[App\Http\Controllers\Tagihans::class,'insert']);
    Route::get('/tagihan/edit/{id_tagihan}',[App\Http\Controllers\Tagihans::class,'edit']);
    Route::post('/tagihan/update/{id_penggunaan}',[App\Http\Controllers\Tagihans::class,'update']);
    Route::get('/tagihan/delete/{id_tagihan}/{id_penggunaan}',[App\Http\Controllers\Tagihans::class,'delete']);
    Route::get('/tagihan/payment_confirm/{id_tagihan}',[App\Http\Controllers\Tagihans::class,'payment_confirm']);

    // Pembayaran
    Route::get('/pembayaran',[App\Http\Controllers\Pembayarans::class,'pembayaran']);
    Route::get('/pembayaran/keliru/{id_tagihan}/{paid_in}',[App\Http\Controllers\Pembayarans::class,'keliru']);
});
