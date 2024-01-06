<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory;
    protected $table = 'page';
    protected $appends = ['logourl'];
    
    public function getLogourlAttribute()
    {
        return url('/').'/images/logo/'.$this->logo;
    }

}
