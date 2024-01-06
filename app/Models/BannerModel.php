<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    use HasFactory;
    protected $table = 'page_banner';
    protected $fillable = [
        'uuid','slug','judul', 'detail','gambar'
    ];
    protected $appends = ['src'];
    
    public function getSrcAttribute()
    {
        return url('/').'/images/banner/'.$this->gambar;
    }
}
