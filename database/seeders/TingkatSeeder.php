<?php

namespace Database\Seeders;

use App\Models\Tingkat;
use Illuminate\Database\Seeder;

class TingkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tingkats = [
            [
                'nama' => 'TK'
            ],
            [
                'nama' => 'SD'
            ],
            [
                'nama' => 'SMP'
            ],
            [
                'nama' => 'SMA'
            ],
        ];

        Tingkat::insert($tingkats);
    }
}
