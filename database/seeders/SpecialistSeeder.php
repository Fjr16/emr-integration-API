<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialists')->delete();
        DB::table('user_specialists')->delete();
        $data = [
            ['id' => 1, 'name' => 'THT'],
            ['id' => 2, 'name' => 'Jantung'],
            ['id' => 3, 'name' => 'Penyakit Dalam'],
            ['id' => 4, 'name' => 'Onkologi'],
            ['id' => 5, 'name' => 'Orthopedi'],
            ['id' => 6, 'name' => 'Bedah Umum'],
            ['id' => 7, 'name' => 'Urologi'],
            ['id' => 8, 'name' => 'Bedah Khusus'],
        ];

        DB::table('specialists')->insert($data);

        $data2 = [
            ['user_id'=>34, 'specialist_id' => 1],
            ['user_id'=>35, 'specialist_id' => 2],
            ['user_id'=>36, 'specialist_id' => 3],
            ['user_id'=>37, 'specialist_id' => 4],
            ['user_id'=>38, 'specialist_id' => 5],
            ['user_id'=>39, 'specialist_id' => 6],
            ['user_id'=>40, 'specialist_id' => 7],
            ['user_id'=>41, 'specialist_id' => 8],
            ['user_id'=>42, 'specialist_id' => 1],
            ['user_id'=>43, 'specialist_id' => 2],
        ];

        DB::table('user_specialists')->insert($data2);
    }
}
