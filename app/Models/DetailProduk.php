<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'tingkat',
        'ukuran',
        'jumlah',
        'harga',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
