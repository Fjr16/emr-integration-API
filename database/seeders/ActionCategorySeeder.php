<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('action_categories')->delete();
        $data = [
            [
                'id' => 1,
                'name' => 'Radiologi',
            ],
            [
                'id' => 2,
                'name' => 'Laboratorium Patologi Klinik',
            ],
            [
                'id' => 3,
                'name' => 'Laboratorium Patologi Anatomi',
            ],
            [
                'id' => 4,
                'name' => 'Tindakan Parasat',
            ],
            [
                'id' => 5,
                'name' => 'Fisiotherapy',
            ]
        ];
        foreach ($data as $item) {
            DB::table('action_categories')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
