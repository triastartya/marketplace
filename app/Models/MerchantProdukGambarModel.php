<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantProdukGambarModel extends Model
{
    use HasFactory;
    protected $table = 'merchant_produk_gambar';
    protected $fillable = [
        'merchant_produk_id', 'path'
    ];
    protected $appends = ['src'];
    
    public function getSrcAttribute()
    {
        return url('/').'/images/produk/'.$this->path;
    }
}
