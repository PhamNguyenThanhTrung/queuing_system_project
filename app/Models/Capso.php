<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capso extends Model
{
    use HasFactory;
   
    protected $table = 'grant';
    protected $primaryKey = 'STT';

    protected $fillable = [
        'STT',
        'MemberName',
        'Name_Dv',
        'source',
        'member_id',
        'ID_Tb', 'created_at','updated_at','expired_at'
    ];
    public function member()
{
    return $this->belongsTo(Member::class);
}

public function thietbis()
{
    return $this->belongsTo(ThietBi::class);
}


}
