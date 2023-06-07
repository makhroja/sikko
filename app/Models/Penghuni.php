<?php

namespace App\Models;
use App\User;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{

    protected $fillable = [
        'user_id',
        'kamar_id',
        'tipe',
        'tgl_masuk',
        'tgl_keluar',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
