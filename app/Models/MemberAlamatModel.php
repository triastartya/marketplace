<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAlamatModel extends Model
{
    use HasFactory;
    protected $table = 'member_alamat';
    protected $fillable = [
        'uuid','member_id', 'no_hp', 'nama', 'alamat', 'detail', 'provinsi', 'kota', 'kelurahan', 'kodepos'
    ];
}