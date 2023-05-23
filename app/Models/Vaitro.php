<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaitro extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'ID_VT';

    protected $fillable = [

        'Name_VT',
        'source',
        'Nhom_A',
        'Nhom_B',
        'member_id',
        'totalMembers'
    ];
    public function member()
{
    return $this->belongsTo(Member::class);
}
public function Dichvu()
{
    return $this->hasMany(Dichvu::class);
}
public function capso()
{
    return $this->hasMany(Capso::class);
}
}
