<?php

namespace App;

use App\Models\Faktur;
use App\Models\Penghuni;
use App\Models\Keluhan;
use App\Models\Tagihan;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'tgl_lahir', 'alamat', 'jk', 'no_hp', 'role', 'email', 'password', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class);
    }

    public function keluhan()
    {
        return $this->hasMany(Keluhan::class);
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function faktur()
    {
        return $this->hasMany(Faktur::class);
    }
}
