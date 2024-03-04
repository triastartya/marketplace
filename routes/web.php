<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\LeandingPageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LeandingPageController::class,'index']);

Route::get('/administrator/login',function(){
    return view('administrator/login');
});

Route::get('/detail/{uuid}',[LeandingPageController::class,'detail']);

Route::get('/produk',[LeandingPageController::class,'list_produk']);

Route::get('/register-toko',function(){
    return view('website/daftar_toko');
});

Route::get('/masuk-toko',function(){
    return view('website/login_toko');
});

Route::get('/keranjang-belanja',function(){
    return view('website/cart');
});

Route::get('/member',[MemberController::class,'member']);
Route::get('order_member',[MemberController::class,'getOrder']);
Route::get('order_produk_member',[MemberController::class,'getOrderProduk']);
Route::post('bukti_transfer',[MemberController::class,'upload_bukti_pembayran']);
Route::post('member/di_terima',[MemberController::class,'di_terima']);

Route::get('/administrator/user', function () {
    return view('administrator.user');
});
Route::get('/administrator/kategori', function () {
    return view('administrator.kategori');
});
Route::get('/administrator/page',[PageController::class,'get']);

Route::get('get_page',[PageController::class,'page']);

Route::get('/administrator/banner', function () {
    return view('administrator.banner.listing');
});

Route::get('/administrator/banner/tambah',function () {
    return view('administrator.banner.input',[
        'id'    =>0,
        'gambar'=>'',
        'judul' =>'',
        'detail'=>'',
    ]);
});
Route::get('/administrator/banner/detail/{id}',[BannerController::class,'detail']);
Route::get('/administrator/konfirmasi',function(){
    return view('administrator/order/konfirmasi');
});
Route::get('/administrator/pencairan',function(){
    return view('administrator/order/pencairan');
});

Route::post('daftar_member',[MemberController::class,'daftar_member']);
Route::post('login_member',[MemberController::class,'login_member']);
Route::post('daftar_merchant',[MerchantController::class,'daftar_merchant']);
Route::post('login_merchant',[MerchantController::class,'login_merchant']);

Route::get('toko',[MerchantController::class,'toko']);
Route::get('produk_toko',[MerchantController::class,'get_produk_toko']);
Route::get('order_produk_toko',[MerchantController::class,'get_order_produk_toko']);

Route::get('delete_produk/{uuid}',[MerchantController::class,'delete_produk']);

Route::get('tambah_produk',[MerchantController::class,'tambah_produk']);
Route::get('edit_produk/{uuid}',[MerchantController::class,'edit_produk']);
Route::post('tambah_produk',[MerchantController::class,'create_produk']);
Route::post('edit_produk',[MerchantController::class,'update_produk']);
Route::post('di_kirim',[MerchantController::class,'kirim_barang']);
Route::post('di_terima',[MerchantController::class,'di_terima']);

Route::post('tambah_keranjang_belanja',[MemberController::class,'tambah_keranjang_belanja']);
Route::get('data_keranjang_belanja',[MemberController::class,'keranjang_belanja']);
Route::post('buat_invoice',[OrderController::class,'buat_order']);
Route::get('get_alamat',[MemberController::class,'get_alamat']);
Route::get('hapus_alamat/{uuid}',[MemberController::class,'hapus_alamat']);
Route::post('tambah_alamat',[MemberController::class,'buat_alamat']);

Route::get('order/{status}',[AdministratorController::class,'order']);
Route::get('konfirmasi',[AdministratorController::class,'konfirmasi']);
Route::post('verifikasi',[AdministratorController::class,'verifikasi']);
Route::get('pengajuan',[AdministratorController::class,'pengajuan_pencairan_dana']);
Route::post('pencairan',[AdministratorController::class,'pencairan']);
Route::get('history_pembayaran',[AdministratorController::class,'history_pembayaran']);

Route::get('logout_member',[MemberController::class,'logout']);
Route::get('logout_merchant',[MerchantController::class,'logout']);

Route::post('edit_profil',[MemberController::class,'edit']);
Route::post('ubah_password_member',[MemberController::class,'ubah_password']);

Route::post('edit_merchant',[MerchantController::class,'edit']);
Route::post('ubah_password_merchant',[MerchantController::class,'ubah_password']);
