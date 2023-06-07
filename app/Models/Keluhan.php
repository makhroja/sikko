<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $fillable = [
        'user_id',
        'keluhan',
        'tgl_keluhan',
        'tgl_tanggapan',
        'solusi',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
