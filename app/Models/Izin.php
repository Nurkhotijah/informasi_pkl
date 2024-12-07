<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $fillable = ['user_id', 'foto_izin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

