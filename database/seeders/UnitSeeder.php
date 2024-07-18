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
            ['name' => 'Pelayanan'],
            ['name' => 'Poliklinik'],
            ['name' => 'Depo Farmasi Rawat Jalan'],
            ['name' => 'Gudang Farmasi'],
            ['name' => 'Administrasi'],
            ['name' => 'Radiologi'],
            ['name' => 'Laboratorium'],
        ];
        DB::table('units')->insert($data);
    }
}
