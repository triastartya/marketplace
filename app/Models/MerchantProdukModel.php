<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantProdukModel extends Model
{
    use HasFactory;
    protected $table = 'merchant_produk';
    protected $fillable = [
        'produk_id','merchant_id','uuid', 'nama_produk', 'keterangan', 'harga', 'diskon', 'harga_jual', 'stok', 'kategori_id', 'rating', 'terjual', 'delete'
    ];
    
    public function merchant(){
        return $this->hasOne(MerchantModel::class,'merchant_id','merchant_id');
    }
    
    public function merchant_produk_gambar(){
        return $this->hasMany(MerchantProdukGambarModel::class,'merchant_produk_id','merchant_produk_id');
    }
    
    public function kategori(){
        return $this->hasOne(KategoriModel::class,'kategori_id','kategori_id');
    }
    
    public function order(){
        return $this->hasMany(TrOrderDetail::class,'merchant_produk_id','merchant_produk_id')
        ->where('status','>=', 5);
    }
}
