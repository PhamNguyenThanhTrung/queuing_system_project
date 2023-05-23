<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dichvu extends Model
{
    use HasFactory;

    protected $table = 'service';
    protected $primaryKey = 'ID_Dv';

    protected $fillable = [
        'ID_Dv',
        'code_Dv',
        'Name_Dv',
        'Describe_Dv',
        'Rules_of_grant',
        'TinhTrang',
        'member_id',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }


    public function ThietBi()
{
    return $this->belongsTo(ThietBi::class);
}

}
