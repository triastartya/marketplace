<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('admin')->group(function () {
    Route::get('user',[UserController::class,'get_all']);
    Route::post('user',[UserController::class,'create']);
    Route::put('user',[UserController::class,'update']);
    Route::delete('user',[UserController::class,'delete']);
    Route::post('login',[UserController::class,'login']);
    
    Route::get('kategori',[KategoriController::class,'get_all']);
    Route::post('kategori',[KategoriController::class,'create']);
    Route::post('kategori_update',[KategoriController::class,'update']);
    Route::delete('kategori/{kategori_id}',[KategoriController::class,'delete']);
    
    Route::post('page',[PageController::class,'update']);
    
    Route::get('banner',[BannerController::class,'get_all']);
    Route::post('banner/create',[BannerController::class,'create']);
    Route::post('banner/update',[BannerController::class,'update']);
    Route::delete('banner/delete/{id}',[BannerController::class,'delete']);
});

Route::prefix('website')->group(function () {
    Route::post('daftar_member',[MemberController::class,'daftar_member']);
});