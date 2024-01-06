<?php

use App\Http\Controllers\BannerController;
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

Route::get('/', function () {
    return view('website/leanding_page');
});

Route::get('/produk',function(){
    return view('website/list_produk');
});

Route::get('/detail',function(){
    return view('website/detail_produk');
});

Route::get('/register-toko',function(){
    return view('website/daftar_toko');
});

Route::get('/masuk-toko',function(){
    return view('website/login_toko');
});

Route::get('/keranjang-belanja',function(){
    return view('website/cart');
});

Route::get('/member',function(){
    return view('website/akun');
});

Route::get('/toko',function(){
    return view('website/toko');
});

Route::get('/administrator/user', function () {
    return view('administrator.user');
});
Route::get('/administrator/kategori', function () {
    return view('administrator.kategori');
});
Route::get('/administrator/page',[PageController::class,'get']);

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