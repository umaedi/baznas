<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'muzakki_id',
        'category_id',
        'nominal',
        'jam',
        'bulan',
        'tahun',
        'status',
        'struk',
        'kwitansi'
    ];

    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
