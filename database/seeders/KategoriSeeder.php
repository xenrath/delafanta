<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            [
                'nama' => 'Mayoret'
            ],
            [
                'nama' => 'Drumband'
            ],
            [
                'nama' => 'Wisuda'
            ],
            [
                'nama' => 'Sepatu & Sandal Kulit'
            ],
        ];

        Kategori::insert($kategoris);
    }
}
