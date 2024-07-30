<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliklinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('polikliniks')->delete();
        $data = [
            [
                'id' => 1,
                'kode' => 'THT',
                'name' => 'Poli THT',
                'kode_antrian' => 'A',
            ],
            [
                'id' => 2,
                'kode' => 'JN',
                'name' => 'Poli Jantung',
                'kode_antrian' => 'B',
            ],
            [
                'id' => 3,
                'kode' => 'INT',
                'name' => 'Poli Penyakit Dalam',
                'kode_antrian' => 'C',
            ],
            [
                'id' => 4,
                'kode' => 'ONK',
                'name' => 'Poli Onkologi',
                'kode_antrian' => 'E',
            ],
            [
                'id' => 5,
                'kode' => 'ORT',
                'name' => 'Poli Orthopedi',
                'kode_antrian' => 'G',
            ],
            [
                'id' => 6,
                'kode' => 'BEDU',
                'name' => 'Poli Bedah Umum',
                'kode_antrian' => 'H',
            ],
            [
                'id' => 7,
                'kode' => 'URO',
                'name' => 'Poli Urologi',
                'kode_antrian' => 'I',
            ],
            [
                'id' => 8,
                'kode' => 'BEDK',
                'name' => 'Poli Bedah Khusus',
                'kode_antrian' => 'K',
            ],
        ];

        foreach ($data as $item) {
            DB::table('polikliniks')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'kode' => $item['kode'],
                'kode_antrian' => $item['kode_antrian'],
                'isActive' => 1,
            ]);
        }
    }
}
