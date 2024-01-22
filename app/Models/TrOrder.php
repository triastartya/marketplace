<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrOrder extends Model
{
    use HasFactory;
    protected $table = 'tr_order';
    protected $fillable = [
        'tr_order_id',
        'tanggal_order',
        'uuid',
        'no_invoice',
        'member_id',
        'keterangan',
        'total_bayar',
        'jml',
        'status',
        'status_bayar',
        'bukti_transfer'
    ];
    
    protected $appends = ['transfer'];
    
    public function getTransferAttribute()
    {
        return url('/').'/images/bukti_transfer/'.$this->bukti_transfer;
    }
    
    public function tr_order_detail()
    {
        return $this->hasMany(TrOrderDetail::class,'tr_order_id','tr_order_id'); 
    }
    
    public function member()
    {
        return $this->hasOne(MemberModel::class,'member_id','member_id');
    }
}
