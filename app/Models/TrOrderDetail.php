<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'tr_order_detail';
    protected $fillable = [
        'tr_order_detail_id',
        'tr_order_id',
        'no_order',
        'merchant_produk_id',
        'merchant_id',
        'member_id',
        'qty',
        'harga',
        'total_harga',
        'status',
        'status_pengiriman',
        'rating',
        'review'
    ];
    
    protected $appends = ['cair'];
    
    public function getCairAttribute()
    {
        return url('/').'/images/bukti_cair/'.$this->bukti_transfer;
    }
    
    public function merchant_produk(){
        return $this->hasOne(MerchantProdukModel::class,'merchant_produk_id','merchant_produk_id');
    }
    
    public function member(){
        return $this->hasOne(MemberModel::class,'member_id','member_id');
    }
    
    public function merchant(){
        return $this->hasOne(MerchantModel::class,'merchant_id','merchant_id');
    }
    
    public function order(){
        return $this->hasOne(TrOrder::class,'tr_order_id','tr_order_id');
    }
}
