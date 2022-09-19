<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiTagihan;
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
// Tagihan
Route::apiResource('/tagihan',App\Http\Controllers\API\ApiTagihan::class);

// penggunaan
Route::apiResource('/penggunaan',App\Http\Controllers\API\ApiPenggunaan::class);

// pembayaran
Route::apiResource('/pembayaran',App\Http\Controllers\API\ApiPembayaran::class);

// Level
Route::apiResource('/level',App\Http\Controllers\API\ApiLevel::class);

// tarif
Route::apiResource('/tarif',App\Http\Controllers\API\ApiTarif::class);

// Users
Route::apiResource('/users',App\Http\Controllers\API\ApiUser::class);
Route::get('/tagihans/{id_tagihan}',[ApiTagihan::class,'single']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
