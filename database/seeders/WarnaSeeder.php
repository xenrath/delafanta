<?php

namespace Database\Seeders;

use App\Models\Warna;
use Illuminate\Database\Seeder;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warnas = [
            [
                'nama' => 'Merah'
            ],
            [
                'nama' => 'Jingga'
            ],
            [
                'nama' => 'Kuning'
            ],
            [
                'nama' => 'Hijau'
            ],
            [
                'nama' => 'Biru'
            ],
            [
                'nama' => 'Nila'
            ],
            [
                'nama' => 'Ungu'
            ],
        ];

        Warna::insert($warnas);
    }
}
