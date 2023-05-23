<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhatky extends Model
{
    protected $table = 'dirty';
    protected $primaryKey = 'ID_NK';

    protected $fillable = [
        'ID_NK',
        'Name_DN',
        'host',
        'operation',
        'member_id',
        'Impact_time',
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
