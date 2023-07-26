<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        foreach ($kategoris as $kategori) {
            Kategori::create([
                'nama' => $kategori['nama'],
                'slug' => Str::slug($kategori['nama'])
            ]);
        }

    }
}
