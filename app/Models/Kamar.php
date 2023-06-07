<?php

namespace App\Models;

use App\Models\Penghuni;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{

    protected $fillable = [
        'nama_kost','no_kamar','lokasi','harga','fasilitas','status',
    ];

    protected $guard = 'id';

    public function penghuni()
    {
        return $this->hasMany(Penghuni::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
