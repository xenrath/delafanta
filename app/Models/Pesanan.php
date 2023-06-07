<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
