<?php

namespace Database\Seeders;

use App\Models\Ukuran;
use Illuminate\Database\Seeder;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ukurans = [
            [
                'nama' => 'S'
            ],
            [
                'nama' => 'M'
            ],
            [
                'nama' => 'L'
            ],
            [
                'nama' => 'XL'
            ],
        ];

        Ukuran::insert($ukurans);
    }
}
