<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = [
        'tgl_pengeluaran',
        'total',
        'keperluan',
        'bukti_pengeluaran',
    ];
}
