<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiContoller;
use App\Http\Controllers\Api\UserController;


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
//     return view('welcome');
// });

Route::get('login',[HomeController::class,'login'])->name('login');
Route::post('login/ceklogin',[HomeController::class,'ceklogin'])->name('ceklogin');
Route::get('register',[HomeController::class,'register'])->name('register');
Route::post('register/daftar',[HomeController::class,'daftar'])->name('daftar');

Route::group(['middleware'=>['auth','Ceklevel:Admin']],function()
{
	Route::get('admin/dashboard',[AdminController::class,'dashboard_admin'])->name('dashboard_admin');
	Route::get('admin/profil',[AdminController::class,'profil_admin'])->name('profil_admin');
	Route::post('admin/profil/ubah/{id}',[AdminController::class,'ubah'])->name('ubah');

	Route::get('admin/pesanan',[AdminController::class,'allpesanan'])->name('allpesanan');
	Route::get('admin/pesanan-sudahbayar',[AdminController::class,'lunas'])->name('lunas');
	Route::get('admin/pesanan-belumbayar',[AdminController::class,'nonlunas'])->name('nonlunas');
	Route::get('admin/pesanan-cek/{kode}',[AdminController::class,'cek_pesanan'])->name('cek_pesanan');
	Route::post('admin/pesanan-cek/confirm',[AdminController::class,'confirm'])->name('confirm');

	//transaksi
	Route::get('admin/transaksi',[AdminController::class,'transaksi_admin'])->name('transaksi_admin');
	Route::get('admin/transaksi/batal/{id}', [AdminController::class, 'batal'])->name('transaksiBatal');
	Route::get('admin/transaksi/konfrim/{id}', [AdminController::class,'konfrim'])->name('transaksiConfirm');

	//transaksiselesai
	Route::get('admin/transaksiselesai',[AdminController::class,'transaksi_selesai'])->name('transaksi_selesai');
	Route::get('admin/transaksiselesai/kirim/{id}', [AdminController::class,'kirim'])->name('transaksiKirim');
	Route::get('admin/transaksiselesai/selesai/{id}', [AdminController::class,'selesai'])->name('transaksiSelesai');


	Route::get('admin/user-petani',[AdminController::class,'user_petani'])->name('user_petani');
	Route::get('admin/user-konsumen',[AdminController::class,'user_konsumen'])->name('user_konsumen');
});

// 
Route::group(['middleware'=>['auth','Ceklevel:Admin,Petani']],function()
{
	Route::get('petani/dashboard',[PetaniController::class,'dashboard'])->name('dashboard');
	Route::get('petani/biodata',[PetaniController::class,'biodata'])->name('biodata');
	Route::post('petani/biodata/lengkapi/{id}',[PetaniController::class,'lengkapi'])->name('lengkapi');
	Route::post('petani/biodata/password/{id}',[PetaniController::class,'ganti_password'])->name('ganti_password');

	Route::get('petani/produk',[PetaniController::class,'produk'])->name('produk');
	Route::post('petani/produk/add',[PetaniController::class,'addproduk'])->name('addproduk');
	Route::post('petani/produk/update/{id}',[PetaniController::class,'updateproduk'])->name('updateproduk');
	Route::get('petani/produk/delete/{id}',[PetaniController::class,'deleteproduk'])->name('deleteproduk');

	Route::get('petani/kategori',[PetaniController::class,'kategori'])->name('kategori');
	Route::post('petani/kategori/addkategori',[PetaniController::class,'addkategori'])->name('addkategori');
	Route::get('petani/kategori/delete/{id}',[PetaniController::class,'deletekategori'])->name('deletekategori');
	Route::post('petani/kategori/update/{id}',[PetaniController::class,'updatekategori'])->name('updatekategori');

	Route::get('petani/payment',[PetaniController::class,'payment'])->name('payment');
	Route::post('petani/payment/add',[PetaniController::class,'addpayment'])->name('addpayment');
	Route::post('petani/payment/update/{id}',[PetaniController::class,'updatepayment'])->name('updatepayment');
	Route::get('petani/payment/delete/{id}',[PetaniController::class,'deletepayment'])->name('deletepayment');

	Route::get('petani/riwayat-checkout',[PetaniController::class,'checkout_konsumen'])->name('checkout_konsumen');
	Route::get('petani/saldo-petani',[PetaniController::class,'saldo_petani'])->name('saldo_petani');

	Route::post('petani/riwayat-checkout/resi/{id}',[PetaniController::class,'upload_resi'])->name('upload_resi');
	Route::post('petani/riwayat-checkout/update_status/{id}',[PetaniController::class,'update_status'])->name('update_status');

});

// 
Route::group(['middleware'=>['auth','Ceklevel:Admin,Petani,Konsumen']],function()
{
	Route::post('read-produk/addcart',[KonsumenController::class,'addcart'])->name('addcart');
	Route::get('keranjang',[KonsumenController::class,'keranjang'])->name('keranjang');
	Route::get('keranjang/hapus/{id}',[KonsumenController::class,'hapus_cart'])->name('hapus_cart');
	Route::post('keranjang/checkout',[KonsumenController::class,'addcheckout'])->name('addcheckout');
	Route::get('riwayatpembelian/{kode}',[KonsumenController::class,'riwayatpembelian'])->name('riwayatpembelian');
	Route::post('riwayatpembelian/bayar/{kode}',[KonsumenController::class,'upload_bayar'])->name('upload_bayar');
	Route::get('data-checkout/confirm/{id}',[KonsumenController::class,'confirm_konsumen'])->name('confirm_konsumen');


	Route::get('profil/konsumen',[KonsumenController::class,'profil_konsumen'])->name('profil_konsumen');
	Route::post('profil/konsumen/lengkapi/{id}',[KonsumenController::class,'konsumen_lengkapi'])->name('konsumen_lengkapi');
	Route::get('contact',[KonsumenController::class,'contact'])->name('contact');

	Route::get('data-checkout',[KonsumenController::class,'data_checkout'])->name('data_checkout');

});

Route::get('/',[KonsumenController::class,'index'])->name('index');
Route::get('read-produk/{id}',[KonsumenController::class,'read'])->name('read');
Route::get('cek-toko',[KonsumenController::class,'cek_toko'])->name('cek_toko');
Route::get('cek-toko/{id_toko}',[KonsumenController::class,'detail_toko'])->name('detail_toko');
Route::get('logout',[HomeController::class,'logout'])->name('logout');

// Route::resource('transaksi',[TransaksiContoller::class,'index']);

	
