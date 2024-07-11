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
        DB::table('medicine_categories')->delete();
        $data = [
            [
                'id' => 1,
                'name' => 'PSIKOTROPIKA',
            ],
            [
                'id' => 2,
                'name' => 'NARKOTIKA',
            ],
            [
                'id' => 3,
                'name' => 'OBAT BEBAS',
            ],
            [
                'id' => 4,
                'name' => 'OBAT BEBAS TERBATAS',
            ],
            [
                'id' => 5,
                'name' => 'OBAT KERAS',
            ],
            [
                'id' => 6,
                'name' => 'JAMU',
            ],
            [
                'id' => 7,
                'name' => 'HERBAL',
            ],
            [
                'id' => 8,
                'name' => 'FITOFARMAKA',
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
