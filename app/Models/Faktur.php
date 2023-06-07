<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    protected $fillable = [
        'user_id',
        'tagihan_id',
        'no_faktur',
        'total_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'tgl_bayar',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
