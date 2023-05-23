<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $table = 'avatar';
    protected $primaryKey = 'ID_Img';

    protected $fillable = [
        'ID_Img',
        'Name_Img',
        'member_id',

    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
