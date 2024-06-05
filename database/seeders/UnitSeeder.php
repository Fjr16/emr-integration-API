<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Komisaris'],
            ['name' => 'Direksi'],
            ['name' => 'Keuangan'],
            ['name' => 'Gizi'],
            ['name' => 'UPSRS'],
            ['name' => 'Logistik Umum'],
            ['name' => 'Pengadaan'],
            ['name' => 'SDM'],
            ['name' => 'Farmasi'],
            ['name' => 'Radiologi'],
            ['name' => 'Labor'],
            ['name' => 'Perawat'],
            ['name' => 'IBA dan Pacu'],
            ['name' => 'Rekam Medis dan casemix'],
            ['name' => 'Akreditasi'],
            ['name' => 'Dokter Jaga'],
        ];
        DB::table('units')->insert($data);
    }
}
