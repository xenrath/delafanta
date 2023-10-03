<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubKategoriSeeder extends Seeder
{
    public function run()
    {
        $sub_kategoris = [
            [
                'kategori_id' => '1',
                'nama' => 'Seragam Mayoret',
                'jenis' => true
            ],
            [
                'kategori_id' => '1',
                'nama' => 'Topi Mayoret',
                'jenis' => true
            ],
            [
                'kategori_id' => '1',
                'nama' => 'Sepatu Mayoret',
                'jenis' => false
            ],
            [
                'kategori_id' => '1',
                'nama' => 'Tongkat Mayoret',
                'jenis' => false
            ],
            [
                'kategori_id' => '1',
                'nama' => 'Fullset Mayoret',
                'jenis' => false
            ],
            [
                'kategori_id' => '2',
                'nama' => 'Seragam Drumband',
                'jenis' => true
            ],
            [
                'kategori_id' => '2',
                'nama' => 'Topi Drumband',
                'jenis' => true
            ],
            [
                'kategori_id' => '2',
                'nama' => 'Sepatu Drumband',
                'jenis' => false
            ],
            [
                'kategori_id' => '3',
                'nama' => 'Baju Wisuda',
                'jenis' => true
            ],
            [
                'kategori_id' => '3',
                'nama' => 'Topi Toga',
                'jenis' => true
            ],
            [
                'kategori_id' => '4',
                'nama' => 'Sepatu Kulit',
                'jenis' => false
            ],
            [
                'kategori_id' => '4',
                'nama' => 'Sandal Kulit',
                'jenis' => false
            ],
        ];

        foreach ($sub_kategoris as $sub_kategori) {
            SubKategori::create([
                'kategori_id' => $sub_kategori['kategori_id'],
                'nama' => $sub_kategori['nama'],
                'jenis' => $sub_kategori['jenis'],
                'slug' => Str::slug($sub_kategori['nama'])
            ]);
        }

    }
}
