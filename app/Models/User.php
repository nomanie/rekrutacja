<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserShift;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = "user_id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_firstname',
        'user_lastname',
    ];

    public function estate()
    {
        return $this->hasMany(Estate::class, 'supervisor_user_id', 'user_id');
    }

    public function shift()
    {
        return $this->belongsTo(UserShift::class, 'user_id', "user_id");
    }

    public function substituteUser()
    {
        return $this->belongsTo(UserShift::class, 'substitute_user_id', "id");
    }
}
