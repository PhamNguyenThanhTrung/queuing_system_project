<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class Member extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use HasFactory, Notifiable, Authenticatable, CanResetPassword;

    protected $table = 'members';
    protected $primaryKey = 'MemberID';
    protected $fillable = [
        'MemberID',
        'MemberName',
        'UserDN',
        'password',
        'Tel','Email',
        'Vaitro',
        'Tinhtrang',

    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }



    public function getAuthIdentifierName()
    {
        return 'MemberID';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function thietbis()
{
    return $this->hasMany(ThietBi::class);
}
public function capsos()
{
    return $this->hasMany(Capso::class);
}
}
