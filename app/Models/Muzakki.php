<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model

class Muzakki extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'no_tlp',
        'dinas_id',
        'jabatan',
        'password',
        'image',
    ];

    public function dinas()
    {
        return $this->belongsTo(Dinas::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function SocialAccount()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
