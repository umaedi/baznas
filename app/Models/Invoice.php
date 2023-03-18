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
        'no_invoice',
        'snap_token',
        'nominal',
        'jam',
        'bulan',
        'tahun',
        'payment_status',
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
