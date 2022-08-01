<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\TransaksiController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
 //   return $request->user();
//});

Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);
Route::post('daftar',[RegisterController::class,'daftar']);
Route::get('produk',[ProdukController::class,'produk'])->name('produk');

Route::post('chekout', [TransaksiController::class, 'store']);
Route::get('chekout/user/{id}', [TransaksiController::class, 'history']);
Route::post('chekout/batal/{id}', [TransaksiController::class, 'batal']);
Route::post('chekout/upload/{id}', [TransaksiController::class, 'upload']);
Route::post('push',[TransaksiController::class,'pushNotif']);