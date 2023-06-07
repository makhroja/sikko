<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'user_id',
        'no_tagihan',
        'tgl_tagihan',
        'bulan',
        'tahun',
        'total_tagihan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
