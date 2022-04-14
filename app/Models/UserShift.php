<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShift extends Model
{
    use HasFactory;

    protected $table ='users_shifts';
    public $timestamps = false;

    protected $casts = [
        'temp_changes' => "array"
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id','id');
    }
    public function substituteUser()
    {
        return $this->hasOne(User::class, 'substitute_user_id', 'id');
    }
}
