<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Seeder;

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

        SubKategori::insert($sub_kategoris);       
    }
}
