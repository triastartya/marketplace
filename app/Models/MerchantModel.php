<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantModel extends Model
{
    use HasFactory;
    protected $table = 'merchant';
    protected $fillable = [
        'uuid', 'email', 'no_hp', 'password', 'nama_toko', 'alamat', 'provinsi', 'kota', 'kelurahan', 'kode_pos', 'logo', 'banner', 'keterangan', 'rating'
    ];
    
    public function merchant_produk(){
        return $this->hasMany(MerchantProdukModel::class,'merchant_id','merchant_id');
    }
}
