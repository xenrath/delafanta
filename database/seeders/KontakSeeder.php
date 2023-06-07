<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kontak = [
            'nama' => 'Delafan Putri Avon',
            'deskripsi' => 'Yayaya',
            'alamat' => 'RT.02/RW.03, Jetis, Pepedan, Kec. Dukuhturi, Kabupaten Tegal, Jawa Tengah 52192',
            'telp'  => '+6282137314711',
        ];
    }
}
