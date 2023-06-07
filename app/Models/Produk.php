<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'subkategori_id',
        'warna',
        'gambar',
    ];

    protected $casts = [
        'gambar' => 'array'
    ];

    public function subkategori()
    {
        return $this->belongsTo(SubKategori::class);
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class);
    }

    public function detail_produks()
    {
        return $this->hasMany(DetailProduk::class);
    }
}
