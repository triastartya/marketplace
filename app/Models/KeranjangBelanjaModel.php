<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangBelanjaModel extends Model
{
    use HasFactory;
    protected $table = 'keranjang_belanja';
    protected $fillable = [
        'member_id','merchant_produk_id', 'qty'
    ];
    
    public function merchant_produk(){
        return $this->hasOne(MerchantProdukModel::class,'merchant_produk_id','merchant_produk_id');
    }
    
}
