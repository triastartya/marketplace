<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $fillable = [
        'uuid', 'email','password', 'no_hp', 'nama'
    ];
    
    function member_alamat(){
        return $this->hasMany(MemberAlamatModel::class,'member_id','member_id');
    }
}
