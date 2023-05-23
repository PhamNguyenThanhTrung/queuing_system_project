<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class ThietBi extends Model
{
    use HasFactory;

    protected $table = 'thietbi';
    protected $primaryKey = 'ID_Tb';

    protected $fillable = [
        'ID_Tb',
        'code_Tb',
        'MemberName',
        'Name_Tb',
        'Diachi',
        'dichvu_Sd',
        'Loai_Tb',
        'UserDN',
        'member_id',
        'TT_ketnoi'
    ];


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($thietbi) {
    //         $currentUserMemberID = Auth::user()->MemberID;

    //         if ($thietbi->member_id == $currentUserMemberID) {
    //             $thietbi->TT_ketnoi = 'Kết nối';
    //         } else {
    //             $thietbi->TT_ketnoi = 'Mất kết nối';
    //         }
    //     });
    // }


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
