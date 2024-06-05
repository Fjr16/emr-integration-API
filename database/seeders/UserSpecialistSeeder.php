<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['user_id'=>34, 'specialist_id' => 1],
            ['user_id'=>35, 'specialist_id' => 2],
            ['user_id'=>36, 'specialist_id' => 3],
            ['user_id'=>37, 'specialist_id' => 3],
            ['user_id'=>38, 'specialist_id' => 3],
            ['user_id'=>39, 'specialist_id' => 4],
            ['user_id'=>40, 'specialist_id' => 3],
            ['user_id'=>41, 'specialist_id' => 5],
            ['user_id'=>42, 'specialist_id' => 6],
            ['user_id'=>43, 'specialist_id' => 7],
            ['user_id'=>44, 'specialist_id' => 5],
            ['user_id'=>45, 'specialist_id' => 6],
        ];

        DB::table('user_specialists')->insert($data);
    }
}
