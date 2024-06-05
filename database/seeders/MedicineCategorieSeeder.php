<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'PSIKOTROPIK',
            ],
            [
                'id' => 2,
                'name' => 'NARKOTIK',
            ],
            [
                'id' => 3,
                'name' => 'BEBAS',
            ],
            [
                'id' => 4,
                'name' => 'BEBAS TERBATAS',
            ],
            [
                'id' => 5,
                'name' => 'KERAS',
            ],
            [
                'id' => 6,
                'name' => 'NONE',
            ],
        ];
        foreach ($data as $item) {
            DB::table('medicine_categories')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
            ]);
        }
    }
}
