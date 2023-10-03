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
        'gambar',
    ];

    public function subkategori()
    {
        return $this->belongsTo(SubKategori::class);
    }
}
