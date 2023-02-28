<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_dinas'];

    public function muzaki()
    {
        return $this->hasMany(Muzakki::class);
    }
}
